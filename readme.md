# Silhouette Fulfillment Challenge.

To run this solution, put index.php and Silhouete.php in the same directory as the case files.
The case file was specified in the challenge.

My solution consists in finding the highest pile and sums the difference between the lowest piles forward until finding a pile higher than the last one.

When a higher pile is found, the algorithm sums the differences with an accumulator, change the higher pile and do the process again until then and of the file's arrays.

I used recursion to walk through the grid array due to its the simplest way to code this solution, in my view, and because I didn't have enough time to code it.

I also submit the first solution, done with functions, that helped me to code the Silhouette class. It was my lab.

To run it just put the index.php and Silhouete.php files with the case file (the grid file) and run:

```php -f index *grid_file_name* -d (optional, for debugging)```

This command will generate a result file called result_grid_file_name.

Thank you for your attention.  
My best regards,  
Leonardo.