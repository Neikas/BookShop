# Foobar

This is Book Stroe project

# Author

 **By Neikas**

live on heroku

http://book-shop-neikas.herokuapp.com/book/

## Installation
Change .env file

```bash
composer intall
npm install
npm run prod
php aritsan migrate:fresh --seed
php artisan serve
```
## User

**admin**
admin@lt.lt
password
**user**
user@lt.lt
password

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
Please make sure to update tests as appropriate.

### TASK 1

# List of all books
- [x] books displayed in 5x5 grid
- [x] the book has a title with author, cover, and genre
- [x] the book can have multiple authors and genres
- [x] all book covers must have consistent dimensions
- [x] when there are more than 25 books on a page, there will be [next] and [previous] buttons
- [x] books uploaded last week should have something to display that they are [NEW]
- [x]  the book may have a discount (by percentage), and I also would like to see that in the listing [10%]
- [x] Search bar when searching for a book it should look for title and author
- [x] lists them in the same layout as the landing page
- [x] a search bar must have a cookie that tracks the previous search you had
- [x] Menu bar
- [x] Login and registration button

# Login page
- [x] a login page must have an email and password
- [x] must have a "remember me"
- [x] must have "forgot password"
- [x] must have a register button
- [x] Registration page
- [x] must have a log in button
- [x] must have an email, password with show password in it, confirm password and date of birth
# Book page
- [x] must have description
- [x] users can leave reviews
- [x] users can rate book
# User Account
- [x] they can change the password
- [x] they can change email
- [x] they can report a book (for example if there are discrepancies on some of the listed books)
- [x] can upload a book to the listing, then the admin must confirm the book to be listed, then it appears on the landing page and searches
can manage their books
- [x] can give a review on a book (stars + comments)
- [x] can chat to admin about report
# Admin account
- [x] they can change the password
- [x] can reply to user's report
- [x] can manage and update all the books
- [x] can replly to user report

### Task 2 Books API and Dynamic Elements

# Create Public API

- [x] Create an endpoint /api/v1/books which would return the books list (only confirmed books), with pagination done by Laravel standards
- [x] Every book should return those fields: id, title, cover full URL, price, authors as string comma-separated, genres as string comma-separated
- [x] You need to use Laravel API Resources for this
- [x] Create an endpoint for a single book /api/v1/books/{id} and show the fields the same as in the list but also add Description field. But you need to use the same Laravel API Resource, just with the condition of when to add the description field or not.

# Post Rating/Review without Page Refresh

- [x] Logged in user can post rating/review, but it needs to be saved immediately on the same page and refresh the list of reviews and the average rating.
- [x] For that, choose your own technology that you want: Vue.js, Laravel Livewire. jQuery will do but not recommended.
- [x] If you choose Vue/jQuery, then on the back-end, there should be an API endpoint created to save review/rating (Authentication with Laravel Sanctum) that would return the full book data with reviews/ratings and then you show that data on the page 


## License
[MIT](https://choosealicense.com/licenses/mit/)