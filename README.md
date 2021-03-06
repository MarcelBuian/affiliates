# dev-codetest
We have a shortlist of affiliate contact records in a text file ([affiliates.txt](http://localhost:8005/affiliates.txt)) -- one affiliate per line, JSON-encoded. We want to invite any affiliate that lives within 100km of our Dublin office for some food and drinks using this text file as the input (Don't alter). Write a program that will read the full list of affiliates from this txt file and output the name and affiliate ids of matching affiliates (within 100km), sorted by Affiliate ID (ascending).

You can use the first formula from this [Wikipedia article](https://en.wikipedia.org/wiki/Great-circle_distance) to calculate distance. Don't forget, you'll need to convert degrees to radians.

The GPS coordinates for our Dublin office are 53.3340285, -6.2535495.

You can find the affiliate list in this repository called affiliates.txt.

Please don’t forget, your code should be production ready, clean and tested!

## Nice to haves:
- Demonstrate understanding of MVC
- Unit Tests
- Basic HTML output
- Usage of a PHP Framework (Not necessary but as a Laravel based company it's a bonus)
- Use original txt file as input

------

# How to use:

## Install
- Ensure you have docker installed
- Run `./vendor/bin/sail up`

## Use the application
- Open [http://localhost:8005/](http://localhost:8005/)

## How to test
- Run `./vendor/bin/sail test`
- Run `./vendor/bin/sail dusk`

## ToDos:
- Create more UI pages
- Add possibility to change and select another file from where the contact records are read
- Improve the UI, make it look better
- Use Ajax endpoints
  - Also add a spinner when loading
  - Validate in realtime when adding contacts
- Make use of Database
- Improve the code
- Add more tests
- Clean up the images from docker that are not used
- Add travis and pipelines
- Add php sniffer
- Add code coverage
