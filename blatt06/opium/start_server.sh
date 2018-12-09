#!/usr/bin/env bash

port=8000
isfree=$(netstat -taln | grep $port)

while [[ -n "$isfree" ]]; do
  port=$[port+1]
  isfree=$(netstat -taln | grep $port)
done

echo "Starting server on Port: $port"

php bin/console server:run 127.0.0.1:$port

exit $?
