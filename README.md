# LeafBBS
LeafBBS&mdash;a Responsive Web BBS from its Cradle

LeafBBS is a bulletin board system(BBS) written in PHP.  
It is designed to run in LAMP server environment.

## Files
### Templates
  + `list.php`
  + `view.php`
  + `compose.php`
  + `pre_edit.php`
  + `pre_del.php`
  + `reply.php`

### Controllers
  + `insert.php`
  + `edit.php`
  + `del.php`
  + `insert_reply.php`
  + `db_connect.php`
  + `index.php`

### Library
  + `common.php`
  + `db_info.php`

## SQL Tables
### Table `leaf_board`
```
CREATE TABLE leaf_board (
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
#### A Statement to Run for Performance Enhancement
```
ALTER TABLE leaf_board ADD UNIQUE thread_index(thread);
```

## Trivia
The former name of LeafBBS is CocoaBBS as it can be observed in this repo commit history. 
However, Plenoh changed the name of this internet bulletin board system(BBS) since he felt unhealthy and noticed the risk of getting diabetes due to his developing dependency on caffeine and sugar. 
Green diet such as lettuce, cucumber, and spinach is much healthier.

## License Information
LeafBBS is licensed and released under GPL v2.
