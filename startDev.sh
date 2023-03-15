#!/bin/bash

# Function to start services and capture output
function start_service() {
  # show the name of the service passed through the first argurment.
  echo "Starting $1..."
  # starts a service in the background, captures its output to the console, and displays the output using the name of the service.
  $2 > >(while read line; do echo "$1: $line"; done) 2>&1 &
}

# Start Vite
start_service "Vite" "npm run dev"

# Start Laravel server
start_service "Laravel server" "php artisan serve"

# Start Mailpit
start_service "Mailpit" "mailpit"

# Start Minio server
start_service "Minio server" "minio server ~/minio --console-address :9090"

# Wait for user to press Ctrl+C
trap "kill 0" SIGINT
wait
echo "Press Ctrl+C to terminate all services"
