SHELL := /bin/bash

default: build

build:
	docker build -t mysht .
	if [ ! -f "port.txt" ]; then cp port-default.txt port.txt; fi

backend:
	./init-backend.sh

run:
	PORT=`cat port.txt` && docker run -d -it -p$$PORT:80 --name mysht-local -v `pwd`/../../frontend:/var/www/html -v `pwd`/../../backend:/usr/local/mysht mysht
