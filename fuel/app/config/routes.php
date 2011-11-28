<?php

return array(
    
    '_root_' => 'blog/index',
    '_404_' => 'errors/404',
    
    // fallback routing: route via slug
    '(:segment)' => 'article/index/$1',
);