<h1 align="center">1fileblog<h1>
<p align="center">
<img src="https://img.shields.io/github/issues-raw/aboutdavid/1fileblog"></img>
<img alt="GitHub" src="https://img.shields.io/github/license/aboutdavid/1fileblog">
</p>

### ❓ What is 1fileblog?
1fileblog is a simple PHP blog which only uses 1 file\*

### ⚙️ How does it work?
Everything is written in PHP and should work in most PHP oriented servers such as apache2, nginx, or even the built in php server (not reccomended for production use).
Posts are authored in markdown files, no web ui or anything, just a simple blog for simple people. 

To create a post, make a new file in the posts directory. The filename before the `.` will be the slug.


The post structure would be the title on the first line, and the rest of the post on the other lines.
```markdown
# Title
content
content
**content** (if markdown enabled)
```

### 💪 How does it compare with wordpress?
WordPress is a blogging platform, and a forum, and a shop, and a auction site, and anything you want. Good in theory, bad when tested. You just want a blog, not everything at once. It can be overwhelming. And, every 3 seconds, a wordpress instance is hacked. That's over 30000 instances per day (souce: [Forbes](https://www.forbes.com/sites/jameslyne/2013/09/06/30000-web-sites-hacked-a-day-how-do-you-host-yours/?sh=6c6647cf1738)). Plus, 1fileblog is a flat file CMS, which means it can render pages faster. Many people expect wordpress pages to load from 1 second to 5 seconds. Try 200ms with 1fileblog. 1fileblog is only one file where you can't change anything without having access to the server (unlike WordPress). 1fileblog has an easy setup process (just change a few settings in blog.php). 1fileblog also has [dead simple caching](https://github.com/aboutDavid/1filecache/blob/main/cache.php) so pages don't get rendered every single time you load

![example of how fast 1fileblog is](https://file.coffee/u/phipwoka07DT99.png)

### 🚀 How do I get started
Run these commands to get started:
```bash
mkdir posts
mkdir cache
curl https://github.com/aboutDavid/1fileblog/raw/main/blog.php -O index.php
# If you want to enable rewrites (default enabled)
curl https://raw.githubusercontent.com/aboutDavid/1fileblog/main/.htaccess
# If you want to enable markdown (default enabled)
curl https://github.com/chadbraunduin/markdown.bash/raw/master/markdown.sh
```

\*unless you want to use markdown, external stylesheet or use url rewrites, then you will need download a few files, but it can function with only 1!
