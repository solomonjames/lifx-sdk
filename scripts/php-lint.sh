#!/usr/bin/env bash
#
# Script to lint all given files using the native php linter
#
# see: https://github.com/Rican7/dotfiles/blob/a957502c9e12617cb042e5f5de0e01087fca2b93/local/bin/php-lint

# Check for dependent-commands
hash nproc 2>/dev/null && nproc=true || nproc=false
hash cat   2>/dev/null && cat=true   || cat=false
hash grep  2>/dev/null && grep=true  || grep=false


# Were any args manually passed?
if [ $# -gt 0 ] ; then
    args="$@"
else
    args="."
fi

# Define some variable defaults
parallel_jobs=2

if $nproc; then
    parallel_jobs="$(nproc)"
elif [ -f /proc/cpuinfo ] && [ -r /proc/cpuinfo ] && $cat && $grep; then
    parallel_jobs="$(cat /proc/cpuinfo | grep -c processor)"
fi


# Find the files and run them through our linter
find $args -name "*.php" -print0 | xargs -n 1 -0 -P $parallel_jobs php -l