<?php
/**
 * Created by PhpStorm.
 * User: sergiovilar
 * Date: 04/05/14
 * Time: 10:52 AM
 */

class Helper {

    // Path methods

    public function img(){
        return ALTER_IMG;
    }

    public function css(){
        return ALTER_CSS;
    }

    public function js(){
        return ALTER_JS;
    }

    public function theme(){
        return THEME_PATH;
    }

    // Utility methods

    public function title(){

        global $page, $paged;

        wp_title( '|', true, 'right' );
        bloginfo( 'name' );

        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";

        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

    }

    public function name(){
        return get_bloginfo('name');
    }

    public function domain(){
        return $_SERVER['HTTP_HOST'];
    }

    public function url(){
        return get_bloginfo('url')."/";
    }

    function menu($menu){
        wp_nav_menu( array('menu' => $menu,'container'=>'false' ));
    }

    function breadcrumb($home = 'Home', $separator = "/"){

        if (!is_home()) {

            echo '<a href="'.get_siteurl().'">Principal »</a>';

            if (is_category() || is_single()) {

                $cats = get_the_category();
                echo "<a href='".get_siteurl().$cats[0]->slug."'>".$cats[0]->name."</a>";
                
                if (is_single()) {
                    echo "<a href='#'> ".$separator." ";
                    the_title();
                    echo "</a>";
                }

            } elseif (is_page()) {

                if($post->post_parent > 0){

                    echo "<a href='".get_permalink($post->post_parent)."'> ".$separator." ";
                    echo get_the_title($post->post_parent);
                    echo "</a>";

                }

                echo "<a href='#'> ".$separator." ";
                echo the_title();
                echo "</a>";
            }
        }

    }

} 