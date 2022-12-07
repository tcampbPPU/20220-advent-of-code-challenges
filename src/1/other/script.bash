#!/usr/bin/env bash

normalize() {
    cat input.txt | paste -sd+ | sed 's/++/\n/g' | sed 's/+*$//g' | bc | sort -n
}

# Problem 1
normalize | tail -1

# Problem 2
normalize | tail -3 | paste -sd+ | bc