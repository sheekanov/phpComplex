<?php
/**
 * Plugin Name: Touristik Calendar
 * Plugin URI:
 * Description: Календарь, который работает одновременно и с Акциями, и с Новостями.
 * Version: 0.1.0
 * Author: sheekanov
 * Author URI: http://www.sheekanov.ru
 * License: GPL v2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pretty-portfolio
 * Domian Path:
 */

function tc_get_calendar() {
    do_action('tc_get_calendar');
}

function tc_calendar() {
    if ($GLOBALS['monthnum'] == 0) {
        $month =  date('n');
        $year = date('Y');
    } else {
        $month = $GLOBALS['monthnum'];
        $year = $GLOBALS['year'];
    }

    $posts = new WP_Query();
    $args = array('post_type' => ['stocks', 'post'], 'posts_per_page' => -1, 'monthnum' => $month, 'year' => $year);
    $myposts = $posts->query($args);
    echo '<div class="sidebar__sidebar-item widget_calendar">';
    echo '<div class="sidebar-item__title">КАЛЕНДАРЬ</div>';

    $postdates = [];
    foreach ($myposts as $post) {
      $postdates[] = date('j',strtotime($post->post_date));

    }

    $dates=[];
    $date = new DateTime('01.' . $month . '.' . $year);
    $monthName = $date->format('F') . ' ' . $year;

    while ($date->format('n') == $month) {
        $dates[$date->format('j')] = $date->format('N');
        $date->add(new DateInterval('P1D'));
    }

    echo '<div class = "calendar_wrap">';
    echo '<table>';
    echo '<caption>' . $monthName . '</caption>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr><td colspan="' . ($dates[1]-1) . '"></td>';
    foreach ($dates as $key => $value) {
        if (in_array($key, $postdates)) {
            echo '<td><a href="/' . $year . '/' . $month . '/' . $key . '">' . $key . '</a></td>';
        } else {
            echo '<td>' . $key . '</td>';
        }

        if ($value % 7 ==0 && $key != count($dates)) {
            echo '</tr><tr>';
        }

        if ($key == count($dates)) {
            echo '</tr>';
        }
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    if ($month == 1) {
        echo '<a href = "/' . ($year-1) . '/' . '12' . '" >Предыдущие </a>';
    } else {
        echo '<a href = "/' . $year . '/' . ($month-1) . '" >Предыдущие </a>';
    }

    if ($month < date('n')) {
        if ($month == 12) {
            echo '<a href = "/' . ($year+1) . '/' . '1' . '" >Следующие </a>';
        } else {
            echo '<a href = "/' . $year . '/' . ($month+1) . '" >Следующие </a>';
        }

    }
    echo '</div>';

}

add_action('tc_get_calendar' , 'tc_calendar');