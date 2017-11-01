<?php
namespace App;

use Illuminate\Support\Collection;

class Wordpleasing {
	public static function quote() {
		return Collection::make([
			'Ever tried, Ever Failed, No matter. Try again, Fail again, Fail better. - Samuel Beckett',
			'If you can\'t make it good, at least make it look good. - Bill Gates.',
			'Design is not just what it looks like and feels like. Design is how it works. - Steve Jobs',
			'When you love someone, the best thing you can offer is your presence. How can you love if you are not there? - Thich Nhat Hanh',
			'Simplicity is an acquired taste. - Katharine Gerould',
			'Very little is needed to make a happy life. - Marcus Antoninus',
			'เมื่อก้าวขึ้นจากท่า เจ้ากับข้า จ่ายคนละสามบาท - เจ้าหน้าที่นิรนาม'
		])->random();
	}
}