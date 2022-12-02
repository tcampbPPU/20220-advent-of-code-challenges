package main

import (
	"fmt"
	"io/ioutil"
	"log"
	"strconv"
	"strings"
)

func main() {
	fileContent, err := ioutil.ReadFile("input.txt")
	if err != nil {
		log.Fatal(err)
	}

	lines := string(fileContent)
	splitLines := strings.Split(lines, "\n\n")

	max := 0
	for _, line := range splitLines {
		sum := 0
		splitLine := strings.Split(line, "\n")
		for _, value := range splitLine {
			intValue, err := strconv.Atoi(value)
			if err != nil {
				log.Fatal(err)
			}
			sum += intValue
		}
		if sum > max {
			max = sum
		}
	}

	fmt.Println("The highest sum is", max)
}
