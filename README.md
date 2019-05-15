# php-printr-tree
PHP function to take print_r output and make it a collapsible tree

I was looking for a way to dump large objects for debugging and be able to navigate them, only viewing the nodes I needed. 

There are other scripts that will iterate arrays and objects into a tree, but unlike print_r, they do not have global access and cannot render private properties.  So I decided to make a print_r parser that could take the output from print_r and render it into a collapsable tree using HTML and jquery.

This is rough code I threw togther and thought I'd share.  I make no guarantees it will work with all objects, but seems to work fine for objects and arrays.  Feel free to make improvements.

