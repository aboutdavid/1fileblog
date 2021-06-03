# 1 file blog

Welcome to **1fileblog**, a simple PHP blog which only uses 1 file\*

Everything is written in PHP and should work in most PHP oriented servers such as apache2, nginx, or even the built in php server (not reccomended for production use).

Posts are authored in markdown files, no web ui or anything, just a simple blog for simple people. WordPress is a blogging platform, and a forum, and a shop, and a auction site, and anything you want. Good in theory, bad when tested. You just want a blog, not everything at once. It can be overwhelming. And, every 3 seconds, a wordpress instance is hacked. That's over 30000 instances per day (souce: [Forbes](https://www.forbes.com/sites/jameslyne/2013/09/06/30000-web-sites-hacked-a-day-how-do-you-host-yours/?sh=6c6647cf1738))

1fileblog is only one file where you can't change anything without having access to the server (unlike WordPress). 1fileblog has an easy setup process (just change a few settings in blog.php)

1fileblog even has caching (you know, to speed up time)

Run these two commands to get started:
```
mkdir posts
mkdir cache
```

To create a post, make a new file in the posts directory. The filename before the `.` will be the slug.


The post structure would be the title on the first line, and the rest of the post on the other lines.
```
# Title
content
content
**content** (if markdown enabled)
```
\*unless you want to use markdown or an external stylesheet, then you will need download a few files
