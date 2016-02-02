<?php
    
    mysqli_query($mysqli, "
        CREATE TABLE jmla_wcatalog_categories (
            id integer(10) UNSIGNED NOT NULL auto_increment,
            title  varchar(255) NOT NULL DEFAULT '',
            description text NULL DEFAULT '',
            parent_id integer NOT NULL default '0',
            ordering integer NOT NULL default '0',
            level integer NOT NULL default '1',
            published tinyint(1) NOT NULL default '0',
            created datetime NOT NULL default '0000-00-00 00:00:00',
            created_by int(10) unsigned NOT NULL default '0',
            modified datetime NOT NULL default '0000-00-00 00:00:00',
            modified_by int(10) unsigned NOT NULL default '0',
            PRIMARY KEY  (id)
        )  DEFAULT CHARSET=utf8;    
    ");
    
    mysqli_query($mysqli, "
        CREATE TABLE jmla_wcatalog_products (
            id integer(10) UNSIGNED NOT NULL auto_increment,
            title  varchar(255) NOT NULL DEFAULT '',
            description text NULL DEFAULT '',
            price float NULL,
            image varchar(255) NULL DEFAULT '',
            category_id integer NOT NULL default '0',
            published tinyint(1) NOT NULL default '0',
            created datetime NOT NULL default '0000-00-00 00:00:00',
            created_by int(10) unsigned NOT NULL default '0',
            modified datetime NOT NULL default '0000-00-00 00:00:00',
            modified_by int(10) unsigned NOT NULL default '0',
            PRIMARY KEY  (id)
        )  DEFAULT CHARSET=utf8;                
    ");