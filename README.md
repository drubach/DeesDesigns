# **Dee's Designs**

This project is meant to provide an online presence for the small local business, Dee's Designs.

Dee's Designs is a small singularly owned boutique graphic design business based in western NY. This project gives Dee's Designs an online platform to advertise their services, and for customers to purchase them, create accounts, edit delivery information, and provide quick contact with the business owner.

[Take a look at the project here]().
<hr>

## **UX**

This site is designed to give the user a visually pleasing way to browse the services and examples for the boutique graphic design firm, Dee's Designs.

For inspiration, I looked at a number of Bootstrap Templates to get a beautiful front end design. In the end, I chose the [LONELY](https://bootstrapmade.com/demo/Lonely/) template from [BOOTSTRAPMADE](https://bootstrapmade.com/). Interestingly enough, this was made especially for a small graphic design firm.
<hr>

### **User Stories:**
#### **First Time Visitor Goals:**
* Easily understand the purpose of the site.
* Quickly learn how to navigate the site and make sure it is intuitively accessible for first time users.
* Visually appealing to have a pleasant first experience.
* Be able to quickly browse examples of designs to quickly determine interest.
* Be able to contact the owner of the store if I have any questions.
* Be able to create an account, submit a request for work.
#### **Returning Visitor Goals:**
* Be able to login/register so information can be saved, and chekcout is handled efficiently.
* Be able to login with my Google account so creating an account is painless.
* Have items that I my have in my project cart still be there when I return.
#### **Frequent User Goals:**
* Be able to save my profile information so that I don't have to re-enter every time I order.
* See my order history to see what I have already bought.
* Have the option to custom order if I want to change something to a particular product.
#### **Site Owner Goals:**
* Showcase work.
* Process orders online.
* Be able to update portfolio.
* See a list of orders.
* Upload finished work and have customer receive notification of completion.
<hr>

### **Design Features Include:**
* **Mobile Menu** - Consolidating the menu down for mobile devices lets it be flexible for device size.

* **Flexible Footer** - Custom JS was written to measure the window and content and intelligently place the footer either fixed at the bottom, or at the bottom of the content.

* **Breadcrumbs** - Breadcrumb headers are included on each page for a beautiful and uniform appearance.

* **Testimonial Carousel** - Testimonials from satisfied customers cycle through on the home page for a pleasing experience.

* **Color Scheme** - The primary colors for the site came from the Bootstrap template. They include white, gray, greenish -blue-gray and a pastel rose color. 
<hr>

### **Wireframes:**
* Desktop - [View](media/Desktop-Dees.png)
* Tablet - [View](media/Tablet-Dees.png)
* Mobile - [View](media/Mobile-Dees.png)
<hr>

### **Database Schema:**
* Diagram - [View](media/DatabaseDesign-Dees.png)
<hr>

### **Features:**
* **User Registration** - Allows user to store their delivery information, their default email, name, phone number, submit a request for services and view their order history.

* **SSO** - Allauth supports signing in and creating an account through many providers, I implemented Google and Facebook.

* **Contact Page** - Allows end users to send emails and questions to the store owner for easy correspondence.

* **Cart Model** - Allows users that are registered with the site to have their cart data stored for easy access if they leave the site and log back in.

* **Responsiveness** - Site responds to all device sizes and looks natural on Desktop, Mobile, and Tablet views.

* **Customizable Store** - Flexible product design allows the owner to add products, edit products, and delete them as their store changes.

* **Checkout** - Integration with Stripe allows people to shop and buy products, complete with confirmation emails for both the consumer, and the store owner.
<hr>

### **Technologies Used:**

#### **Languages Used:**
* HTML5
* CSS3
* JavaScript
* Python
* Jinja
<hr>

#### **Frameworks, Libraries & Programs Used:**

* **Bootstrap 4.5.0** - Bootstrap was used to assist with the responsiveness and styling of the website.

* **Font Awesome** - Font Awesome was used on most pages throughout the website to add icons for aesthetic purposes.

* **Git** - Git was used for version control by utilizing VS Code to commit to Git and Push to GitHub.
GitHub

* **GitHub** -  is used to store the project's code after being pushed from Git.

* **Balsamiq** - Balsamiq was used to create the wireframes during the design process.

* **JQuery** - JQuery was used to write shorter, simpler Javascript.

* **Hover.css** - Hover.css is used to change the text and background color of buttons and links upon hovering over them.

* **Django** - Django is the Python framework that this project was built on.
Allauth

* **Allauth** -  is used for the authentication models, and SSO for this project.

* **Postgres SQL** - Django uses a relational database system by default, and Heroku has a free Postgres extension to add on to any app.
<hr>

## **Bugs**

* **Slider not working** - Direction to implement correctly from [Easy Tutorials YouTube Channel](https://www.youtube.com/watch?v=9yLxmbICrTM).

* **Counters not working** - Direction to implement correctly from [GitHubHot.com](https://githubhot.com/repo/cncagency/purecounterjs).

* **Back to top button not working** - Moved position of Javascript to the bottom of the HTML body.

* **Couldn't load example project data** - Error: "sqlite3.IntegrityError: UNIQUE constraint failed: projects_project.user_id" resulted from using models.OneToOneField. Changed to models.ForeignKey for user_id for project and issue resolved.

* **Couldn't log into admin in Heroku** - Error: "Please enter the correct username and password for a staff account. Note that both fields may be case-sensitive." Direction to correct found in [StackOverflow](https://stackoverflow.com/questions/68109989/unable-to-login-to-heroku-admin-panel-after-successfully-creating-superuser).

* **Media files are not showing up** - Error: "typeerror: expected str, bytes or os.pathlike object, not tuple". A hint was found in the second and not checked answer in this article from [StackOverflow](https://stackoverflow.com/questions/64320840/typeerror-expected-str-bytes-or-os-pathlike-object-not-tuple-how-to-solve).

## **Credits**
### **Media**
* The majority of the media was provided within the Bootstrap template.

* Favicons were generated using this [Generator](https://www.favicon-generator.org/).

* Icons were taken from [Flaticon.com](https://www.flaticon.com/packs/alphabet-and-numbers-18).

* Logos, poster, portraits and murals were taken from [Kaggle.com](https://www.kaggle.com/datasets/thedownhill/art-images-drawings-painting-sculpture-engraving).
<hr>

### **Content**

* Any content not provided in the template was written by the developer.
<hr>

### **Code**
* Some of the Python and HTML templating was taken from the Boutique Ado Project because the premise of an online store is the same.

* Some ideas were also taken from looking at the website for the online business [VyeRose](https://vyerose.herokuapp.com/).

* Thumbnail code for project images was taken from [W3 Schools](https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_thumbnail_image).

* Code to implement project card filtering on my projects page was taken from [css-tricks.com](https://css-tricks.com/in-page-filtered-search-with-vanilla-javascript/).

* Code for sending an email manually in Django was taken from this Stack Overflow post.

* Documentation for implementing signing in with Google was provided by the Django Allauth docs.

* HTML and CSS for Google sign in button found in this Codepen post.
<hr>

## **Acknowledgments**
* My mentor Caleb Mbakwe for continuous and helpful support/design suggestions.
* My tutor James for giving me the guidance I needed at just the right time.
* My son for his patient assistance and encouragement that an old dog can learn new tricks.
<hr>