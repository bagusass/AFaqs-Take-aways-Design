<?php

/**
 * Plugin Name:       AFaqs Take-aways Design
 * Plugin URI:        https://github.com/bagusass/
 * Description:       faqs take aways design for better user experience
 * Version:           1.0.1
 * Author:            Bagus Khrisna Ardi
 * Author URI:        https://github.com/bagusass
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * 
 */

 function replace_content_formats($content) {
    $key_patterns = [
        '/<h[234]>Key Takeaways<\/h[234]>(\s*(<p>.*?<\/p>|<ul>\s*(<li>.*?<\/li>){1,3}<\/ul>))/s',
        '/<div class="key-takeaways">\s*<p><h3>Key Takeaways<\/h3>\s*<p>(.*?)<\/p><\/div>/s',
        '/<h[24]>Key Takeaways:<\/h[24]>\s*<ul>(.*?)<\/ul>/s',
        '/<h4>Key Takeaways:<\/h4>\s*<ul>(.*?)<\/ul>/s',
        '/Key Takeaways:\s*((-\s*[^<]+(<br\s*\/?>|\n|$))+)/s'
    ];
    
    foreach ($key_patterns as $key_pattern) {
        $content = preg_replace_callback($key_pattern, function($matches) {
            if (!empty($matches[1])) {
                return '<div class="custom-key-takeaways"><h4>Key Takeaways:</h4>' . $matches[1] . '</div>';
            } elseif (!empty($matches[2])) {
                return '<div class="custom-key-takeaways"><h4>Key Takeaways:</h4>' . $matches[2] . '</div>';
            } elseif (!empty($matches[3])) {
                return '<div class="custom-key-takeaways"><h4>Key Takeaways:</h4>' . $matches[3] . '</div>';
            } elseif (!empty($matches[4])) {
                return '<div class="custom-key-takeaways"><h4>Key Takeaways:</h4>' . $matches[4] . '</div>';
            } elseif (!empty($matches[5])) {
                return '<div class="custom-key-takeaways"><h4>Key Takeaways:</h4>' . $matches[5] . '</div>';
            }
        }, $content);
    }
    
    

    $faq_patterns = [
        '/<h2>FAQs<\/h2>(.*?)<p><h3>/s',
        '/<p><h2>Frequently Asked Questions<\/h2>(.*?)<\/p><\/p>/s', 
        '/<p><h2>Frequently Asked Questions<\/h2>(.*?)<p><b>Source:/s',
        '/<h4>FAQs:<\/h4>(.*?)<h3>Conclusion:<\/h3>/s',
        '/<strong>FAQs<\/strong>(.*?)<b>/s'
    ];
    
    foreach ($faq_patterns as $pattern) {
        $content = preg_replace_callback($pattern, function($matches) {
            if (!empty($matches[1])) {
                return '<h2>FAQs</h2><div class="custom-faqs">' . $matches[1] . '</div>';
            } elseif (!empty($matches[2])) {
                return '<h2>Frequently Asked Questions</h2><div class="custom-faqs">' . $matches[2] . '</div>';
            } elseif (!empty($matches[3])) {
                return '<h2>Frequently Asked Questions</h2><div class="custom-faqs">' . $matches[3] . '</div><p><b>Source:';
            } elseif (!empty($matches[4])) {
                return '<h2>FAQs</h2><div class="custom-faqs">' . $matches[4] . '</div><h3>Conclusion:</h3>';
            } elseif (!empty($matches[5])) {
                return '<h2>FAQs</h2><div class="custom-faqs">' . $matches[5] . '</div>';
            }
        }, $content);
    }
    
    
    return $content;
}

add_filter('the_content', 'replace_content_formats');

function my_custom_faq_shortcode($atts, $content = null) {
    return '<div class="my-custom-faq">' . do_shortcode($content) . '</div>';
}
add_shortcode('myfaq', 'my_custom_faq_shortcode');

function my_custom_faq_styles() {
    wp_enqueue_style('my-custom-faq-css', plugin_dir_url(__FILE__) . 'style.css');
}

add_action('wp_enqueue_scripts', 'my_custom_faq_styles');



?>