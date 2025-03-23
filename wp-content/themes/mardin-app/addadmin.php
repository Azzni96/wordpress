<?php
/* Template Name: Admin Page */
get_header();
global $wpdb;
?>

<div class="container">
    <h1>Admin Dashboard</h1>

    <!-- MENU ITEMS -->
    <section class="admin-section">
        <h2>Menu Items</h2>
        <?php
        $menus = $wpdb->get_results("SELECT * FROM menu");
        foreach ($menus as $menu) {
            echo '<div class="menu-item-admin">';
            echo '<h4>' . esc_html($menu->name) . ' - €' . esc_html($menu->price) . '</h4>';
            echo '<p>' . esc_html($menu->description) . '</p>';
            echo '<p>Category: ' . esc_html($menu->category) . '</p>';
            echo '</div>';
        }
        ?>
    </section>

    <!-- FEEDBACKS -->
    <section class="admin-section">
        <h2>Feedbacks</h2>
        <?php
        $feedbacks = $wpdb->get_results("SELECT * FROM feedback");
        foreach ($feedbacks as $feedback) {
            echo '<div class="feedback-item-admin">';
            echo '<p><strong>' . esc_html($feedback->name) . '</strong> (' . esc_html($feedback->rating) . '⭐)</p>';
            echo '<p>' . esc_html($feedback->message) . '</p>';
            echo '</div>';
        }
        ?>
    </section>
</div>

<?php get_footer(); ?>
