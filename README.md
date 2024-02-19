To start the project run 'docker compose up -d --build' <br/>
If something goes wrong, run 'docker compose down' and then 'docker system prune -a' that will delete all containers to start from 'fresh start'.<br/>
If you were runnig kubernetes before you need to delete all images in kubernetes context too because there are sometimes conflicts between images and containers. <br/>
Very rarely but if you on Ubuntu sometimes you eve need to restart it and then run 'docker system prune -a'  <br/>
Put '127.0.0.1       claryfi_test.com' into /etc/hosts. <br/>
To get into fpm container 'docker exec -it claryfi_test-fpm-1 bash' <br/>
You'll see your app on http://claryfi_test.com/ (not https://claryfi_test.com/)


