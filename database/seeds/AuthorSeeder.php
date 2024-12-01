<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Author::create([
            'name' => 'Rosie Nguyễn',
            'sex' => 'Nữ',
            'birthday' => '1987-01-01',
            'story' => '<p><strong>Rosie Nguyễn</strong> sinh ng&agrave;y 01-01-1987 tại Tỉnh B&igrave;nh Định, nước Việt Nam. C&ocirc; sống v&agrave; l&agrave;m việc chủ yếu ở Th&agrave;nh phố Hồ Ch&iacute; Minh, nước Việt Nam. C&ocirc; sinh thuộc cung (chưa r&otilde;), cầm tinh con (gi&aacute;p) m&egrave;o (Đinh M&atilde;o 1987). Rosie Nguyễn xếp hạng nổi tiếng thứ 54728 tr&ecirc;n thế giới v&agrave; thứ 185 trong danh s&aacute;ch Blogger nổi tiếng. Tổng d&acirc;n số của Việt Nam năm 1987 v&agrave;o khoảng 61,75 triệu người.</p>',
        ]);
        \App\Author::create([
            'name' => 'Richard David Precht',
            'sex' => 'Nam',
            'birthday' => '1964-12-08',
            'story' => '<p><strong>Richard David Precht</strong> sinh ng&agrave;y 8 th&aacute;ng 12 năm 1964 l&agrave; một triết gia người Đức v&agrave; l&agrave; t&aacute;c giả của những cuốn s&aacute;ch khoa học phổ biến th&agrave;nh c&ocirc;ng về c&aacute;c vấn đề triết học . Anh ấy dẫn chương tr&igrave;nh TV-Show &quot;Precht&quot; tr&ecirc;n Truyền h&igrave;nh Đức (ZDF).</p>',
        ]);
        \App\Author::create([
            'name' => 'Thomas J. DeLong',
            'sex' => 'Nam',
            'birthday' => '1933-09-06',
            'story' => '<p><strong>Thomas J. DeLong</strong>&nbsp;l&agrave; một th&agrave;nh vi&ecirc;n cao cấp v&agrave; cựu Gi&aacute;o sư Thực h&agrave;nh Quản l&yacute; Philip J. Stomberg trong lĩnh vực H&agrave;nh vi tổ chức tại Trường Kinh doanh Harvard.&nbsp;Từ năm 1997, DeLong đ&atilde; giảng dạy hơn 15.000 MBA v&agrave; Gi&aacute;m đốc điều h&agrave;nh cả trong khu&ocirc;n vi&ecirc;n trường v&agrave; tr&ecirc;n to&agrave;n thế giới.&nbsp;&Ocirc;ng được quốc tế c&ocirc;ng nhận về giảng dạy v&agrave; ph&aacute;t triển kh&oacute;a học.&nbsp;DeLong đ&atilde; viết hơn 100 trường hợp v&agrave; ghi ch&uacute; giảng dạy trong nhiệm kỳ của m&igrave;nh tại HBS cũng như ba cuốn s&aacute;ch.</p>',
        ]);
        \App\Author::create([
            'name' => 'Charles Duhigg',
            'sex' => 'Nam',
            'birthday' => '1974-07-17',
            'story' => '<p><strong>Charles Duhigg</strong>&nbsp;(sinh năm 1974) l&agrave; một nh&agrave; b&aacute;o v&agrave; t&aacute;c giả phi hư cấu người Mỹ từng đoạt giải Pulitzer.&nbsp;&Ocirc;ng l&agrave; ph&oacute;ng vi&ecirc;n của B&aacute;o New York&nbsp;v&agrave; l&agrave; t&aacute;c giả của hai cuốn s&aacute;ch về th&oacute;i quen v&agrave; năng suất, c&oacute; tựa đề Sức mạnh của th&oacute;i quen: Tại sao ch&uacute;ng ta l&agrave;m những g&igrave; ch&uacute;ng ta l&agrave;m trong cuộc sống v&agrave; kinh doanh&nbsp;v&agrave; Th&ocirc;ng m&igrave;nh hơn nhanh hơn.</p>',
        ]);
    }
}
