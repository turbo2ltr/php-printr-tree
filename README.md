# php-printr-tree
PHP function to take print_r output and make it a collapsible tree

I was looking for a way to dump large objects and still be able to navigate them. There are other scripts that will iterate arrays and objects into a tree, but print_r has global access to even private members and properties.  So I decided to make a print_r parser that could take the output and turn it into a collapsable tree.

This is rough code I threw togther and thought I'd share.  I make no guarantees it will work with all objects, but seems to work fine for objects and arrays.  Feel free to make improvements.

