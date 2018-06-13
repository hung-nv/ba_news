<?php

function getMeta() {
	return \App\Models\Option::select( 'key', 'value' )->pluck( 'value', 'key' );
}