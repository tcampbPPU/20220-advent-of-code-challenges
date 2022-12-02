package main

import (
	"errors"
	"fmt"
	"io/ioutil"
	"net/http"
	"strconv"
	"strings"
)

func main() {
	b, err := fetch("https://adventofcode.com/2022/day/1/input", "session", "COPY FROM ENV")
	if err != nil {
		panic(err)
	}

	s := string(b)
	lines := explode("\n", s)

	matrix := make([][]int, len(lines))
	matrixIdx := 0
	lastRow := 0
	for i, line := range lines {
		if line == "" {
			matrix[matrixIdx] = make([]int, len(lines[lastRow:i]))
			for j, v := range lines[lastRow:i] {
				matrix[matrixIdx][j], err = strconv.Atoi(v)
				if err != nil {
					panic(err)
				}

			}

			lastRow = i + 1
			matrixIdx++
		}
	}

	// fmt.Println(matrix)

	highestSum := 0

	for i := 0; i < len(matrix); i++ {
		for j := 0; j < len(matrix[i]); j++ {
			sum := matrix[i][j]
			for k := j + 1; k < len(matrix[i]); k++ {
				sum += matrix[i][k]
				if sum > highestSum {
					highestSum = sum
				}
			}
		}
	}

	fmt.Println("The highest sum is", highestSum)

}

// Helper function to fetch a URL
func fetch(url string, name string, value string) (b []byte, err error) {
	req, err := http.NewRequest("GET", url, nil)
	if err != nil {
		return
	}

	req.AddCookie(&http.Cookie{Name: name, Value: value})

	client := &http.Client{}
	resp, err := client.Do(req)
	if err != nil {
		return
	}
	defer resp.Body.Close()

	if resp.StatusCode != 200 {
		err = errors.New(url +
			"\nresp.StatusCode: " + strconv.Itoa(resp.StatusCode))
		return
	}

	return ioutil.ReadAll(resp.Body)
}

// Helper function to explode a string similar to PHP
func explode(delimiter, text string) []string {
	if len(delimiter) > len(text) {
		return strings.Split(delimiter, text)
	} else {
		return strings.Split(text, delimiter)
	}
}
