# **Dee's Designs**

This project is meant to provide an online presence for the small local business, Dee's Designs.

Dee's Designs is a small singularly owned boutique graphic design business based in western NY. This project gives Dee's Designs an online platform to advertise their services, and for customers to purchase them, create accounts, edit delivery information, and provide quick contact with the business owner.

[Take a look at the project here](https://dees-designs.herokuapp.com/).
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
* Have items that I my have in my project cart still be there when I return.
#### **Frequent User Goals:**
* Be able to save my profile information so that I don't have to re-enter every time I order.
* Have the option to custom order if I want to change something to a particular product.
#### **Site Owner Goals:**
* Showcase work.
* Process orders online.
* Be able to update portfolio.
* See a list of orders.
* Upload finished work to portfolio.
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
* **User Registration** - Allows user to store their delivery information, their default email, name, phone number, submit a request for services.

* **Cart Model** - Allows users that are registered with the site to have their cart data stored for easy access if they leave the site and log back in.

* **Responsiveness** - Site responds to all device sizes and looks natural on Desktop, Mobile, and Tablet views.

* **Customizable Store** - Flexible project design allows the owner to add projects, and delete them as their store changes.

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

* **Constant Pylint errors** - Error: "Class has no 'objects' member". Solved by installing <i>pylint-django</i> adding a plug in for for this to python.linting.pylintArgs. Instruction to implement from [koenwoortman.com](https://koenwoortman.com/python-django-pylint-class-has-no-objects-member/).

* **Adding or removing items from cart 500 errors** - Fixed by using direction from this post in [StackOverflow](https://stackoverflow.com/questions/11241668/what-is-reverse).

* **Can't log in to Admin** - Error is "AttributeError: 'ForwardOneToOneDescriptor' object has no attribute 'pk'". Tried to modify File "C:\Users\rubac\anaconda3\lib\site-packages\django\contrib\admin\templatetags\log.py", line 20, in render
    user_id = context[self.user].pk to .id.

* **Toasts not working** - Toasts did not show. Wrote toasts.js to get them to show. Toasts did not close. Added function to specifically close when clicked.

* **Deployed site not working** - Identified multiple issues. Forgot to remove testing code and to uncomment correct code related to user model, Stripe and cart.

## **Testing** 
### **Functionality**
* The Website was tested on Google Chrome, Microsoft Edge and Safari browsers and found to function correctly.

* The website was viewed and tested on a variety of devices such as Desktop, Laptop, iPhone7, iPhone 8 & iPhoneX and found to function correctly.

* Friends and family members were asked to review the site and documentation to point out any bugs and/or user experience issues.

### **Website Performance**
Lighthouse developer tools were used to test the website performance. The four areas examined are load performance, accessibility, best practices and search engine optimiztation. #### [Lighthouse](https://developers.google.com/web/tools/lighthouse)
- ![Lighthouse Performance Test](/media/Lighthouse.png "Lighthouse performance test results")

### **Code Syntax**
Three different online tools were used to validate there were no syntax errors in the project.

#### [W3C HTML Validator](https://jigsaw.w3.org/css-validator/#validate_by_input)
- ![HTML Syntax Test](/media/HTMLValidator.png "W3 HTML Syntax Validator test results")

#### [W3C CSS Validator](https://jigsaw.w3.org/css-validator/#validate_by_input) 
- ![HTML Syntax Test](/media/HTMLValidator.png "W3 HTML Syntax Validator test results")

#### [ExtendsClass Validator](https://extendsclass.com/javascript-fiddle.html)
ExtendsClass Javascript test
User Stories
User	Story	Application Feature or Design Element
A player aged between 5-13 years old:	Easily understood and operated controls.	One button to press to play the game. One button to save the high score or not in a seperate alert.
Responsive and functional on all devices.	The game was designed mobile first and works on mobile and laptop devices.
Feedback to know when I have been successful or not.	A succesful hit is registered by an image change giving immediate positive feedback. Alerts at the end of the game let you know if you beat your high score or not.
Increase the challenge when my abilities improve.	There is a built in feature, automatically increasing the speed of play.
Positive feedback when I hit a new high score.	There is built in high score recognition during the session. Additionally, local storage is used to save the high score between sessions.
Appealing icons and images that I can understand.	The images for the game are simple, cartoonish, fun and brightly colored. The icons for the social media links are standard and easily recognized.
A parent of a player	An appealing game, so that my child and I can have a positive experience when using it.	The game is responsive on all devices and platforms and design choices emphasize color and simple fun graphics.
To know who developed the game and to be able to contact them easily.	There is a simple footer that identifies the developer in the copyright information and provides links to multiple social media for contact purposes.
Technologies Used

## **Future Work**
* Automate unit tests.
* Edit information to the project requests.
* Automate emails for progress status of the project order.
* Add SSO to allow for easier registering and signing in.
* Allow customers to automatically filter to view all their projects.

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

* Code to implement project card filtering on my projects page was taken from [css-tricks.com](https://css-tricks.com/in-page-filtered-search-with-vanilla-javascript/) and [ricardometring.com](https://ricardometring.com/getting-the-value-of-a-select-in-javascript).

* Code to get drop down value from ModelForm on change was taken from this post on [StackOverflow](https://stackoverflow.com/questions/46124531/how-can-i-add-a-onchange-js-event-to-select-widget-in-django).

* Code to push footer around was taken from [martinpennock.com](http://martinpennock.com/blog/force-footer-bottom-page-css/).

* Code for check-all function taken from this post on [StackOverflow](https://stackoverflow.com/questions/18537609/how-to-check-all-checkboxes-using-jquery).

* Code for sending an email manually in Django was taken from this Stack Overflow post.

* Documentation for implementing signing in with Google was provided by the Django Allauth docs.

* HTML and CSS for Google sign in button found in this Codepen post.
<hr>

## **Acknowledgments**
* My mentor Caleb Mbakwe for continuous and helpful support/design suggestions.
* My tutor James for giving me the guidance I needed at just the right time.
* My son Jake for his patient assistance and encouragement that an old dog can learn new tricks.
<hr>