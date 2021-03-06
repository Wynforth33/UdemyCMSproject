<?php
//////////////////////////////////////////////////////////////////
// GENERAL 
//////////////////////////////////////////////////////////////////
  
  // APPLICATION TITLE: 
    define("APP_TITLE", "PHP CMS Project");

  // SETTINGS : Modify the values to Change how Posts are displayed.  
    // POST DISPLAY SETTINGS
    define("GEN_POST_LIMIT", 5);

    // HOME PAGE
    define("HOME_POST_LIMIT", 5);
    define("HOME_POST_ORDERBY", "post_date");
    define("HOME_POST_ORDER", "DESC");
    
    // SEARCH PAGE
    define("SEARCH_POST_LIMIT", 5);
    define("SEARCH_POST_ORDERBY", "post_date");
    define("SEARCH_POST_ORDER", "DESC");

    // CATEGORY PAGE
    define("CAT_POST_LIMIT", 20);
    define("CAT_POST_ORDERBY", "post_date");
    define("CAT_POST_ORDER", "DESC");
    
    // AUTHOR PAGE
    define("AUTHOR_POST_LIMIT", 5);
    define("AUTHOR_POST_ORDERBY", "post_date");
    define("AUTHOR_POST_ORDER", "DESC");

  // CATEGORY DISPLAY LIMITS
    // NAVBAR
    define("NAV_CAT_LIMIT", 5);

    // SIDEBAR
    define("SIDE_CAT_LIMIT", null);

  // PAGE INFO: Modifiy to change info on page.
    // HOME PAGE
    define("HOME_HEAD", "HOME");
    define("HOME_DESC", "PHP CMS Project");

    // SEARCH PAGE
    define("SEARCH_HEAD", "SEARCH");
    define("SEARCH_DESC", "View your results");

  // REGISTRATION  
    // COST PARAMETER 
    define("HASH", "$2y$10$");

    // RANDOM SALTS
    define("SALT1", "rbhR1Sc11nBdtBAGuOYI4h");
    define("SALT2", "HCreiOuxWKbYw79tEdAdHm");
    define("SALT3", "X9EJz5tpW8gxyDZSYhlZlP");
    define("SALT4", "iq2TwaPGzeL5TIFNnvqTfa");

//////////////////////////////////////////////////////////////////
// ADMINISTRATION
//////////////////////////////////////////////////////////////////
  
  // APPLICATION TITLE: 
    define("APP_TITLE_ADMIN", "PHP CMS Administration");

  // SETTINGS : Modify the values to Change how Posts are displayed.  
    // CATEGORY DISPLAY LIMITS
    // ADMIN CATEGORIES PAGE
    define("ADMIN_CAT_LIMIT", null);
?>