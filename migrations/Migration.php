<?php
abstract class Migration {
    abstract public function up($conn);
    abstract public function down($conn);
}
