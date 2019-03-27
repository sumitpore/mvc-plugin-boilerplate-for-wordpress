<?php
namespace Plugin_Name\Core\Registry;

if ( ! class_exists( __NAMESPACE__ . '\\' . 'Model' ) ) {
	class Model {
		use Base_Registry;
	}
}
