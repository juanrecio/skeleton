#!/bin/sh


while ! nc -z rabbitmq 5672;
do
  echo "Waiting AMQP. Slepping";
  sleep 1;
done;
echo "Connected to AMQP!";

sh $1;
