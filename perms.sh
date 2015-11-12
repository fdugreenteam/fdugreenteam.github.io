find . -type f -exec setfacl -m "g:http:r--" {} +
find . -type d -exec setfacl -m "g:http:r-x" {} +
