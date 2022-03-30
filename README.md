# **Dee's Designs**

This project is meant to provide an online presence for the small local business, Dee's Designs.

Dee's Designs is a small singularly owned boutique graphic design business based in western NY. This project gives Dee's Designs an online platform to advertise their services, and for customers to purchase them, create accounts, edit delivery information, and provide quick contact with the business owner.

Take a look at the project [here***REMOVED***().
<hr>

## **UX**

This site is designed to give the user a visually pleasing way to browse the services and examples for the boutique graphic design firm, Dee's Designs.

For inspiration, I looked at a number of Bootstrap Templates to get a beautiful front end design. In the end, I chose the [LONELY***REMOVED***(https://bootstrapmade.com/demo/Lonely/) template from [BOOTSTRAPMADE***REMOVED***(https://bootstrapmade.com/). Interestingly enough, this was made especially for a small graphic design firm.

### **User Stories:**#### **First Time Visitor Goals:**
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
### **Design Features Include:**
* **Mobile Menu** - Consolidating the menu down for mobile devices lets it be flexible for device size.

* **Flexible Footer** - Custom JS was written to measure the window and content and intelligently place the footer either fixed at the bottom, or at the bottom of the content.

* **Breadcrumbs** - Breadcrumb headers are included on each page for a beautiful and uniform appearance.

* **Testimonial Carousel** - Testimonials from satisfied customers cycle through on the home page for a pleasing experience.

* **Color Scheme** - The primary colors for the site came from the Bootstrap template. They include white, gray, greenish -blue-gray and a pastel rose color. 
<hr>

### **Wireframes:**
* Desktop - [View***REMOVED***(media/Desktop%20-%20Dees.pdf)
* Tablet - [View***REMOVED***(media/Tablet%20-%20Dees.pdf)
* Mobile - [View***REMOVED***(media/Mobile%20-%20Dees.pdf)
<hr>

### **Database Schema:**
* Diagram - [View***REMOVED***(media/DatabaseDesign%20-%20Dees.pdf)
<hr>

### **Features:**
* **User Registration** - Allows user to store their delivery information, their default email, name, phone number, submit a request for services and view their order history.

* ~~**Google Sheets Integration** - When an order is created, the order information from the Order Model gets pushed to a Google Sheet for the owner of the store to keep track of.~~

* **SSO** - Allauth supports signing in and creating an account through many providers, I implemented Google and Facebook.

* ~~**2 Factor Authentication** - Django-allauth-2fa supports 2 factor authentication through authentication apps like Google Authenticator.~~

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

* ~~**Django-GSheets** - A forked branch of django-gsheets was used for Google Sheet integration which coerces all data in a model to a string so it can be passed to the sheet.~~ 

* **Postgres SQL** - Django uses a relational database system by default, and Heroku has a free Postgres extension to add on to any app.

* ~~**Allauth 2FA** - Adds 2 factor authentication to django-allauth.~~
<hr>

