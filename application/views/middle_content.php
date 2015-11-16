<div id="middle-content-manager">
    <?php
    if (isset($SHOW_COVER_PHOTO)) {
        include 'middle_column/cover_photo.php';
    }
    ?>
    <div>
        <div id="middle_show_error"></div>
        <?php
        if (isset($section_middle_content)) {

            if (isset($section_middle_data)) {
                $this->load->view($section_middle_content, $section_middle_data);
            } else {
               $this->load->view($section_middle_content);
            }
        }
        ?>
    </div>
</div>