#!/usr/bin/env bash

# Problem 1 - 15422
cat input.test | sed 's/ /+/' \
    | sed 's/\(A+Y\|B+Z\|C+X\)/6+\1/' \
    | sed 's/\(A+Z\|B+X\|C+Y\)/0+\1/' \
    | sed 's/\(A+X\|B+Y\|C+Z\)/3+\1/' \
    | tr 'ABCXYZ' '000123'
    | bc | paste -sd+ | bc

# Problem 2 - 15442
cat input.txt | sed 's/ //' \
    | sed 's/\(.*X\)/0+\1/' \
    | sed 's/\(.*Y\)/3+\1/' \
    | sed 's/\(.*Z\)/6+\1/' \
    | sed 's/BX\|AY\|CZ/1/' \
    | sed 's/AZ\|BY\|CX/2/' \
    | sed 's/AX\|CY\|BZ/3/' \
    | bc | paste -sd+ | bc
