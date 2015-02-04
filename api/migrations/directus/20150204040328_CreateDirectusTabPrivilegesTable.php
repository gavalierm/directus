<?php

/*
CREATE TABLE `directus_tab_privileges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `tab_blacklist` varchar(500) DEFAULT NULL,
  `nav_override` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

class CreateDirectusTabPrivilegesTable extends Ruckusing_Migration_Base
{
    public function up()
    {
      $t = $this->create_table("directus_tab_privileges", array(
          "id"=>false,
          "options"=>"ENGINE=InnoDB DEFAULT CHARSET=utf8"
        )
      );

      //columns
      $t->column("id", "integer", array(
          "limit"=>11,
          "unsigned"=>true,
          "null"=>false,
          "AUTO_INCREMENT"=>true,
          "primary_key"=>true
        )
      );
      $t->column("group_id", "integer", array(
          "limit"=>11,
          "DEFAULT"=>NULL
        )
      );
      $t->column("tab_blacklist", "string", array(
          "limit"=>500,
          "DEFAULT"=>NULL
        )
      );
      $t->column("nav_override", "text");

      $t->finish();
    }//up()

    public function down()
    {
      $this->drop_table("directus_tab_privileges");
    }//down()
}
