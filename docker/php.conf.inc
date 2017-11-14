    
    include fastcgi.conf;

    fastcgi_connect_timeout 60;
    fastcgi_send_timeout 180;
    fastcgi_read_timeout 180;
    fastcgi_buffer_size 256k;
    fastcgi_buffers 8 256k;
    fastcgi_busy_buffers_size 256k;
    fastcgi_temp_file_write_size 256k;
    fastcgi_intercept_errors on;

    #fastcgi_index   index.php;

    #fastcgi_pass unix:/var/run/fastcgi.socket;
