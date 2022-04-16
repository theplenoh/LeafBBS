# CocoaBBS

CocoaBBS is a bullet-in board system(BBS) written in PHP.  
It is designed to run in LAMP server environment.

## Create SQL Tables
### Table `cocoa_board`
```
CREATE TABLE cocoa_board (
    postID int(11) unsigned NOT NULL AUTO_INCREMENT, 
    thread int(11) unsigned NOT NULL, 
    depth int(11) unsigned NOT NULL default '0', 
    name varchar(20) NOT NULL, 
    email varchar(30), 
    password varchar(16) NOT NULL, 
    title varchar(70) NOT NULL, 
    content text NOT NULL, 
    datetime int(11) NOT NULL, 
    ipaddr varchar(16) NOT NULL, 
    views int(11) NOT NULL default '0',
    PRIMARY KEY (postID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
```

## License Information
CocoaBBS is licensed and released under GPL v2.
