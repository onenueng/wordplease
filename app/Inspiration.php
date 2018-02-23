<?php

namespace App;

class Inspiration
{
    public static function inspireMe()
    {
        $quotes = [
            [
                'text' => '“Knowledge is knowing that a tomato is a fruit, wisdom is not putting it in a fruit salad.”',
                'cite' => 'Miles Kington'
            ],
            [
                'text' => "“Don't cry because it's over, smile because it happened.”",
                'cite' => 'Dr. Seuss'
            ],
            [
                'text' => "“Be yourself; everyone else is already taken.”",
                'cite' => 'Oscar Wilde'
            ],
            [
                'text' => "“So many books, so little time.”",
                'cite' => 'Frank Zappa'
            ],
            [
                'text' => "“Go on, be wrong 'cause tomorrow you'll be right.”",
                'cite' => 'Sing Street'
            ],
            [
                'text' => "“Make your own kind of music even if nobody else sings along.”",
                'cite' => 'Cass Eilliot'
            ],
            [
                'text' => "“It's life's illusions I recall, I really don't know life at all.”",
                'cite' => 'Joni Mitchell'
            ],
            [
                'text' => "“You only live once, but if you do it right, once is enough.”",
                'cite' => 'Mae West'
            ],
            [
                'text' => "“Be the change that you wish to see in the world.”",
                'cite' => 'Mahatma Gandhi'
            ],
            [
                'text' => "“In three words I can sum up everything I've learned about life: it goes on.”",
                'cite' => 'Robert Frost'
            ],
            [
                'text' => "“If you want to know what a man's like, take a good look at how he treats his inferiors, not his equals.”",
                'cite' => 'J.K. Rowling'
            ],
            [
                'text' => "“No one can make you feel inferior without your consent.”",
                'cite' => 'Eleanor Roosevelt'
            ],
            [
                'text' => "“If you tell the truth, you don't have to remember anything.”",
                'cite' => 'Mark Twain'
            ],
            [
                'text' => "“A friend is someone who knows all about you and still loves you.”",
                'cite' => 'lbert Hubbard'
            ],
            [
                'text' => "“I've learned that people will forget what you said, people will forget what you did, but people will never forget how you made them feel.”",
                'cite' => 'Maya Angelou'
            ],
            [
                'text' => "“Always forgive your enemies; nothing annoys them so much.”",
                'cite' => 'Oscar Wilde'
            ],
            [
                'text' => "“Fairy tales are more than true: not because they tell us that dragons exist, but because they tell us that dragons can be beaten.”",
                'cite' => 'Neil Gaiman'
            ],
            [
                'text' => "“Yesterday is history, tomorrow is a mystery, today is a gift of God, which is why we call it the present.”",
                'cite' => 'Bil Keane'
            ],
            [
                'text' => "“I have not failed. I've just found 10,000 ways that won't work.”",
                'cite' => 'Thomas A. Edison'
            ],
            [
                'text' => "“Love all, trust a few, do wrong to none.”",
                'cite' => 'William Shakespeare'
            ],
            [
                'text' => "“If you're going to do something wrong, do it right.”",
                'cite' => 'Zoe'
            ],
            [
                'text' => "“If you can't make it good, at least make it look good.”",
                'cite' => 'Bill Gates'
            ],
            [
                'text' => "“My favorite things in life don't cost any money. It's really clear that the most precious resource we all have is time.”",
                'cite' => 'Steve Jobs'
            ],
            [
                'text' => "“It’s more fun to be a pirate than to join the navy.”",
                'cite' => 'Steve Jobs'
            ],
            [
                'text' => "“อย่าให้ผมตลกมากเลย นึกถึงภาพพจน์ นายกฯบ้าง”",
                'cite' => 'พลเอกประยุทธ์ จันทร์โอชา'
            ],
            [
                'text' => "“ต้องเรียนรู้ที่จะอยู่กับน้ำ… หาอาชีพเสริมให้ประชาชนเช่นการประมง”",
                'cite' => 'พลเอกประยุทธ์ จันทร์โอชา'
            ],
            [
                'text' => "“แหวนแม่ นาฬิกาเพื่อน”",
                'cite' => 'พลเอกประวิตร วงษ์สุวรรณ'
            ],
            [
                'text' => "“ตลอดชีวิตรับราชการของผมเกือบจะเรียกได้ว่าอาชีพตำรวจนี่ถือว่าเป็นไซด์ไลน์อาชีพหลักๆ ผมคือทำธุรกิจ”",
                'cite' => 'พล.ต.อ.สมยศ พุ่มพันธุ์ม่วง'
            ],
            [
                'text' => "“เมื่อก้าวขึ้นจากท่า เจ้ากับข้า จ่ายคนละสามบาท”",
                'cite' => 'เจ้าหน้าที่นิรนาม'
            ],
            [
                'text' => "“Tell me and I forget. Teach me and I remember. Involve me and I learn.”",
                'cite' => 'Benjamin Franklin'
            ],
            [
                'text' => "“The secret of getting ahead is getting started.”",
                'cite' => 'Mark Twain'
            ],
            [
                'text' => "“If opportunity doesn't knock, build a door.”",
                'cite' => 'Milton Berle'
            ],
            [
                'text' => "“Always remember that you are absolutely unique. Just like everyone else.”",
                'cite' => 'Margaret Mead'
            ],
            [
                'text' => "“Wise men speak because they have something to say; Fools because they have to say something.”",
                'cite' => 'Plato'
            ],
            [
                'text' => "“Problems are not stop signs, they are guidelines.”",
                'cite' => 'Robert H. Schuller'
            ],
            [
                'text' => "“The only true wisdom is in knowing you know nothing.”",
                'cite' => 'Socrates'
            ],
            [
                'text' => "“Everything has beauty, but not everyone sees it.”",
                'cite' => 'Confucius'
            ],
            [
                'text' => "“Believe you can and you're halfway there.”",
                'cite' => 'Theodore Roosevelt'
            ],
            [
                'text' => "“Do not dwell in the past, do not dream of the future, concentrate the mind on the present moment.”",
                'cite' => 'Buddha'
            ],
            [
                'text' => "“Don't judge each day by the harvest you reap but by the seeds that you plant.”",
                'cite' => 'Robert Louis Stevenson'
            ],
            [
                'text' => "“Nothing is impossible, the word itself says 'I'm possible'!”",
                'cite' => 'Audrey Hepburn'
            ],
            [
                'text' => "“Sometimes your joy is the source of your smile, but sometimes your smile can be the source of your joy.”",
                'cite' => 'Thich Nhat Hanh'
            ],
            [
                'text' => "“If you love someone but rarely make yourself available to him or her, that is not true love.”",
                'cite' => 'Thich Nhat Hanh'
            ],
            [
                'text' => "“ชีวิตที่ดีที่สุดคือ สงบ เย็นและเป็นประโยชน์”",
                'cite' => 'พุทธทาสภิกขุ'
            ],
            [
                'text' => "“ความทุกข์สอนอะไรๆให้เราได้ดีกว่าความสุข”",
                'cite' => 'พุทธทาสภิกขุ'
            ],
            [
                'text' => "“Everyone thinks of changing the world, but no one thinks of changing himself.”",
                'cite' => 'Leo Tolstoy'
            ],
            [
                'text' => "“The two most powerful warriors are patience and time.”",
                'cite' => 'Leo Tolstoy'
            ],
            [
                'text' => "“”",
                'cite' => ''
            ],
        ];


        return $quotes[random_int(0, count($quotes) - 2)];
    }
}
