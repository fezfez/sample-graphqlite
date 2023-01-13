# Linked to https://github.com/thecodingmachine/graphqlite/pull/543

This repo is only here to expose a problem in graphqlite. it contains a very simple show case of the problem.

# how to run locally

## tools need

- git
- docker
- docker-compose
- make

# command to run

- clone the repo
- run `make init`
- run `make test` 


`make init` will run `docker-compose up -d` + a `composer install`.
`make test` will run the scripts `run-test.php`

# the problem

the `MyCustomInputType` is well recognize by graphqlite (it exists in the introspection) but when the mutation is run an expection
is throw with the message `cannot find GraphQL type "MyCustomInputType". Check your TypeMapper configuration.`