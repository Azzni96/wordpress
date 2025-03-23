<?php
/* Template Name: Home Page */
get_header();
global $wpdb;
?>

<div class="container">
    <nav class="main-nav">
        <ul>
            <li><a href="<?php echo site_url('/'); ?>">Home</a></li>
            <li><a href="<?php echo site_url('/addadmin'); ?>">Admin</a></li>
        </ul>
    </nav>


    <h1>Welcome to Mardin Restaurant</h1>

    <section>
        <h2>Menu</h2>
        <div class="menu-grid">
            <?php
            $menus = $wpdb->get_results("SELECT * FROM menu ORDER BY created_at DESC");
            foreach ($menus as $menu) {
                echo '<div class="menu-card">';
                echo '<img src="/uploads/' . esc_attr($menu->image) . '" alt="' . esc_attr($menu->name) . '">';
                echo '<h4>' . esc_html($menu->name) . ' - €' . esc_html($menu->price) . '</h4>';
                echo '<p>' . esc_html($menu->description) . '</p>';
                echo '<span class="category">' . esc_html($menu->category) . '</span>';
                echo '</div>';
            }
            ?>
        </div>
    </section>


    <?php

    global $wpdb;

    // Lomakkeen käsittely ennen sivun sisältöä
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_name'])) {
        $name = sanitize_text_field($_POST['feedback_name']);
        $message = sanitize_textarea_field($_POST['feedback_message']);
        $rating = intval($_POST['feedback_rating']);

        $wpdb->insert('feedback', [
            'name' => $name,
            'message' => $message,
            'rating' => $rating
        ]);

        echo '<p style="color: green;">Feedback submitted successfully!</p>';
    }
    ?>


    <div class="container">
        <h1>Welcome to Mardin Restaurant</h1>

        <!-- Feedback form -->
        <section>
            <h2>Leave Feedback</h2>
            <form method="POST">
                <p>
                    <label for="feedback_name">Your Name</label>
                    <input type="text" id="feedback_name" name="feedback_name" required>
                </p>
                <p>
                    <label for="feedback_message">Your Feedback</label>
                    <textarea id="feedback_message" name="feedback_message" required></textarea>
                </p>
                <p>
                    <label for="feedback_rating">Rating</label>
                    <select name="feedback_rating" id="feedback_rating" required>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </p>
                <button type="submit">Send Feedback</button>
            </form>
        </section>

        <!-- Feedback List -->
        <section>
            <h2>All Feedback</h2>
            <?php
            $feedbacks = $wpdb->get_results("SELECT * FROM feedback ORDER BY created_at DESC");
            foreach ($feedbacks as $feedback) {
                echo '<div class="feedback-item">';
                echo '<p><strong>' . esc_html($feedback->name) . '</strong> (' . esc_html($feedback->rating) . '⭐)</p>';
                echo '<p>' . esc_html($feedback->message) . '</p>';
                echo '</div>';
            }
            ?>
        </section>
    </div>

    <section class="about">
        <h2>Contact Information</h2>
        <ul>
            <li><strong>Address:</strong> Isonnevantie 24, 00320 Helsinki, Finland</li>
            <li><strong>Email:</strong> <a href="mailto:info@mardinpizzeria.fi">info@mardinpizzeria.fi</a></li>
            <li><strong>Phone:</strong> <a href="tel:+35895666690">+358 9 566 6690</a></li>
            <li><strong>Y-tunnus:</strong> 2475739-4</li>
            <li><strong>Opening hours:</strong> Mon–Sun 10:00 – 21:30</li>
        </ul>
    </section>

</div>

<?php get_footer(); ?>
