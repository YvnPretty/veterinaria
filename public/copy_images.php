<?php
if (!is_dir(__DIR__ . '/img')) {
    mkdir(__DIR__ . '/img', 0777, true);
}
copy('/home/yvnsu/.gemini/antigravity/brain/71d7b95a-ca1e-465f-bdf9-c5a5184fadb7/dr_perrito_1778767987103.png', __DIR__ . '/img/dr_perrito.png');
copy('/home/yvnsu/.gemini/antigravity/brain/71d7b95a-ca1e-465f-bdf9-c5a5184fadb7/dogs_banner_1778766712037.png', __DIR__ . '/img/dogs_banner.png');
echo "Images copied successfully.";
