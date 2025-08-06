<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bangladesh Chronicle - Latest News from Bangladesh</title>
    <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        color: #333;
        line-height: 1.6;
      }

      .top-bar {
        background-color: #1a3e72;
        color: white;
        padding: 8px 0;
        font-size: 14px;
      }

      .container {
        width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
      }

      .flex-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .date-time {
        display: flex;
        gap: 20px;
      }

      .social-icons {
        display: flex;
        gap: 15px;
      }

      .social-icons a {
        color: white;
        text-decoration: none;
        font-size: 16px;
      }

      header {
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px 0;
      }

      .logo {
        font-size: 36px;
        font-weight: bold;
        color: #1a3e72;
        text-decoration: none;
      }

      .logo span {
        color: #e51937;
      }

      nav {
        background-color: #e51937;
      }

      .nav-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
      }

      .nav-item {
        position: relative;
      }

      .nav-link {
        color: white;
        text-decoration: none;
        padding: 15px 20px;
        display: block;
        font-weight: 500;
        transition: background-color 0.3s;
      }

      .nav-link:hover {
        background-color: #c4142d;
      }

      .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
          url("https://groups.google.com/group/digital-services-2024/attach/25a9aa043ccfb/6.jpg?part=0.1&view=1")
            center/cover no-repeat;
        height: 500px;
        display: flex;
        align-items: flex-end;
        margin-bottom: 30px;
      }

      .hero-content {
        padding: 40px;
        color: white;
        max-width: 800px;
      }

      .hero-category {
        background-color: #e51937;
        color: white;
        padding: 5px 15px;
        display: inline-block;
        font-size: 14px;
        margin-bottom: 15px;
        text-transform: uppercase;
      }

      .hero-headline {
        font-size: 42px;
        margin: 0 0 20px 0;
        line-height: 1.2;
      }

      .hero-excerpt {
        font-size: 18px;
        margin-bottom: 20px;
      }

      .read-more {
        background-color: #1a3e72;
        color: white;
        padding: 10px 25px;
        text-decoration: none;
        display: inline-block;
        border-radius: 4px;
        transition: background-color 0.3s;
      }

      .read-more:hover {
        background-color: #142d54;
      }

      .main-content {
        display: flex;
        gap: 30px;
        margin-bottom: 40px;
      }

      .content-left {
        flex: 2;
      }

      .content-right {
        flex: 1;
      }

      .section-title {
        font-size: 24px;
        color: #1a3e72;
        border-bottom: 3px solid #e51937;
        padding-bottom: 10px;
        margin-bottom: 20px;
      }

      .news-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }

      .news-card {
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
      }

      .news-card:hover {
        transform: translateY(-5px);
      }

      .news-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
      }

      .news-content {
        padding: 20px;
      }

      .news-category {
        color: #e51937;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
      }

      .news-title {
        font-size: 20px;
        margin: 0 0 10px 0;
      }

      .news-excerpt {
        color: #666;
        margin-bottom: 15px;
        font-size: 15px;
      }

      .news-meta {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: #888;
      }

      .sidebar-widget {
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
      }

      .widget-title {
        background-color: #1a3e72;
        color: white;
        padding: 15px;
        margin: 0;
        font-size: 18px;
      }

      .news-list {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .news-item {
        padding: 15px;
        border-bottom: 1px solid #eee;
      }

      .news-item:last-child {
        border-bottom: none;
      }

      .news-item a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
      }

      .news-item a:hover {
        color: #e51937;
      }

      .trending-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 15px;
      }

      .tag {
        background-color: #f0f0f0;
        color: #333;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
        text-decoration: none;
        transition: background-color 0.3s;
      }

      .tag:hover {
        background-color: #e51937;
        color: white;
      }

      .breaking-news {
        background-color: #e51937;
        color: white;
        padding: 15px 0;
        margin-bottom: 30px;
      }

      .breaking-container {
        display: flex;
        align-items: center;
      }

      .breaking-label {
        background-color: white;
        color: #e51937;
        padding: 5px 15px;
        font-weight: bold;
        margin-right: 20px;
        text-transform: uppercase;
        font-size: 14px;
      }

      .breaking-text {
        font-weight: 500;
        font-size: 16px;
      }

      footer {
        background-color: #1a3e72;
        color: white;
        padding: 40px 0 20px;
      }

      .footer-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin-bottom: 30px;
      }

      .footer-column h3 {
        color: #e51937;
        font-size: 18px;
        margin-bottom: 20px;
      }

      .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .footer-link {
        margin-bottom: 10px;
      }

      .footer-link a {
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s;
      }

      .footer-link a:hover {
        color: white;
      }

      .copyright {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 14px;
        color: #aaa;
      }
    </style>
  </head>
  <body>
    <div class="top-bar">
      <div class="container flex-container">
        <div class="date-time">
          <span>Friday, May 24, 2025</span>
          <span>Last Updated: 10:15 AM</span>
        </div>
        <div class="social-icons">
          <a href="#">Facebook</a>
          <a href="#">Twitter</a>
          <a href="#">YouTube</a>
          <a href="#">Instagram</a>
        </div>
      </div>
    </div>

    <header>
      <div class="container flex-container">
        <a href="#" class="logo">Bangladesh<span>Chronicle</span></a>
        <div class="search-bar">
          <input type="text" placeholder="Search news..." />
          <button>Search</button>
        </div>
      </div>
    </header>

    <nav>
      <div class="container">
        <ul class="nav-menu">
          <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link">National</a></li>
          <li class="nav-item">
            <a href="#" class="nav-link">International</a>
          </li>
          <li class="nav-item"><a href="#" class="nav-link">Business</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Sports</a></li>
          <li class="nav-item">
            <a href="#" class="nav-link">Entertainment</a>
          </li>
          <li class="nav-item"><a href="#" class="nav-link">Technology</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Lifestyle</a></li>
        </ul>
      </div>
    </nav>

    <div class="hero">
      <div class="hero-content">
        <span class="hero-category">Politics</span>
        <h1 class="hero-headline">
          Government Announces New Economic Package to Boost Growth
        </h1>
        <p class="hero-excerpt">
          The finance minister unveiled a comprehensive stimulus package aimed
          at reviving the economy post-pandemic with focus on SMEs and
          agriculture sectors.
        </p>
        <a href="#" class="read-more">Read More</a>
      </div>
    </div>

    <div class="breaking-news">
      <div class="container breaking-container">
        <span class="breaking-label">Breaking</span>
        <span class="breaking-text"
          >Dhaka Metro Rail Phase 2 construction to begin next month, says
          transport minister</span
        >
      </div>
    </div>

    <div class="container main-content">
      <div class="content-left">
        <h2 class="section-title">Latest News</h2>

        <div class="news-grid">
          <article class="news-card">
            <img
              src="https://businesspostbd.com/files/media/daily-media/2023/05/04/40.png"
              alt="News Image"
              class="news-image"
            />
            <div class="news-content">
              <span class="news-category">Business</span>
              <h3 class="news-title">
                Export Earnings Reach Record High in April
              </h3>
              <p class="news-excerpt">
                Bangladesh's export earnings grew by 32% year-on-year in April,
                reaching $4.5 billion, according to EPB data.
              </p>
              <div class="news-meta">
                <span>Business Desk</span>
                <span>2 hours ago</span>
              </div>
            </div>
          </article>

          <article class="news-card">
            <img
              src="https://outspoken.newagebd.com/files/img/202405/cae068df451842e9521752806b052042.jpg"
              alt="News Image"
              class="news-image"
            />
            <div class="news-content">
              <span class="news-category">Sports</span>
              <h3 class="news-title">
                Bangladesh Cricket Team Announces Squad for World Cup
              </h3>
              <p class="news-excerpt">
                The BCB has announced a 15-member squad for the upcoming ICC
                World Cup with two new faces in the team.
              </p>
              <div class="news-meta">
                <span>Sports Reporter</span>
                <span>Today, 11:30 AM</span>
              </div>
            </div>
          </article>

          <article class="news-card">
            <img
              src="https://img.etimg.com/thumb/width-420,height-315,imgsize-33604,resizemode-75,msid-120524127/tech/funding/defence-tech-startup-vayudh-raises-10-million-in-round-led-by-vy-capitals-offshoot-dharana-capital/new-rs-10000-cr-fund-to-boost-startup-ecosystem.jpg"
              alt="News Image"
              class="news-image"
            />
            <div class="news-content">
              <span class="news-category">Technology</span>
              <h3 class="news-title">
                Local Startup Raises $10 Million in Funding
              </h3>
              <p class="news-excerpt">
                A Dhaka-based fintech startup has secured Series A funding from
                international investors to expand operations.
              </p>
              <div class="news-meta">
                <span>Tech Correspondent</span>
                <span>Today, 9:45 AM</span>
              </div>
            </div>
          </article>

          <article class="news-card">
            <img
              src="https://ecdn.dhakatribune.net/contents/cache/images/800x450x1/uploads/dten/2021/03/hospital-picture-1-1615480642687.jpg"
              alt="News Image"
              class="news-image"
            />
            <div class="news-content">
              <span class="news-category">Health</span>
              <h3 class="news-title">
                New Hospital to Open in Chattogram Next Month
              </h3>
              <p class="news-excerpt">
                The 500-bed specialized hospital will provide advanced cardiac
                and neuro treatment facilities in the region.
              </p>
              <div class="news-meta">
                <span>Health Reporter</span>
                <span>Yesterday, 5:20 PM</span>
              </div>
            </div>
          </article>
        </div>
      </div>

      <div class="content-right">
        <div class="sidebar-widget">
          <h3 class="widget-title">Most Read</h3>
          <ul class="news-list">
            <li class="news-item">
              <a href="#">Fuel prices may increase again next week</a>
            </li>
            <li class="news-item">
              <a href="#">Dhaka's air quality worsens to 'unhealthy' level</a>
            </li>
            <li class="news-item">
              <a href="#"
                >New education policy to be implemented from next year</a
              >
            </li>
            <li class="news-item">
              <a href="#">Stock market gains for third consecutive day</a>
            </li>
            <li class="news-item">
              <a href="#">Flood warning issued for northern districts</a>
            </li>
          </ul>
        </div>

        <div class="sidebar-widget">
          <h3 class="widget-title">Trending Topics</h3>
          <div class="trending-tags">
            <a href="#" class="tag">#Election2025</a>
            <a href="#" class="tag">#Budget</a>
            <a href="#" class="tag">#MetroRail</a>
            <a href="#" class="tag">#Cricket</a>
            <a href="#" class="tag">#Startup</a>
            <a href="#" class="tag">#Environment</a>
          </div>
        </div>

        <div class="sidebar-widget">
          <h3 class="widget-title">Editor's Pick</h3>
          <ul class="news-list">
            <li class="news-item">
              <a href="#"
                >Analysis: The challenges of Bangladesh's growing economy</a
              >
            </li>
            <li class="news-item">
              <a href="#">Feature: The changing face of rural Bangladesh</a>
            </li>
            <li class="news-item">
              <a href="#">Opinion: Digital transformation in education</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <footer>
      <div class="container">
        <div class="footer-grid">
          <div class="footer-column">
            <h3>Bangladesh Chronicle</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="#">About Us</a></li>
              <li class="footer-link"><a href="#">Contact</a></li>
              <li class="footer-link"><a href="#">Careers</a></li>
              <li class="footer-link"><a href="#">Advertise</a></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3>Services</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="#">e-Paper</a></li>
              <li class="footer-link"><a href="#">Archives</a></li>
              <li class="footer-link"><a href="#">Mobile App</a></li>
              <li class="footer-link"><a href="#">Newsletter</a></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3>Categories</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="#">National</a></li>
              <li class="footer-link"><a href="#">International</a></li>
              <li class="footer-link"><a href="#">Business</a></li>
              <li class="footer-link"><a href="#">Sports</a></li>
            </ul>
          </div>

          <div class="footer-column">
            <h3>Connect With Us</h3>
            <ul class="footer-links">
              <li class="footer-link"><a href="#">Facebook</a></li>
              <li class="footer-link"><a href="#">Twitter</a></li>
              <li class="footer-link"><a href="#">Instagram</a></li>
              <li class="footer-link"><a href="#">YouTube</a></li>
            </ul>
          </div>
        </div>

        <div class="copyright">
          &copy; 2025 Bangladesh Chronicle. All Rights Reserved.
        </div>
      </div>
    </footer>
  </body>
</html>
