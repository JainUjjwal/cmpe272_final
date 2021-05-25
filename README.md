# # CMPE 272 Final marketplace
## _Dev guide_


Current file directory information:

- Index.php contains nothing and needs login/signup + website redirection implementation.
- productPage.php contains 4 cards displaying the 4 websites and clicking on the button lists the products from those websites (allProductPage.php). 
- allProductPage.php lists the products from the sql DB, clicking on review product opens review.php.
- review.php shows the reviews for the product
-- Adding a review is still pending in review.php

## Current working flow

- load in the application using xampp 
- nopening index.php on your browser displays a button that redirects to productPage.php
- All websites (except for HikeLife) have working product displays.
- Clicking on list products for omnifoods will load omnifoods products.
- Clicking on add review on luxury will list 2 reviews that were added manually to the database. Any other product on the website will display "No Reviews Found".

## Pending work as of 05/25/21 - 1:38 am
- landing page (or index.php)
- add reviews.
- analytics page implementation.
