*********************************************************************GROUP 7 READ ME************************************************************************************************
Group Members: 

- Kshitij Paithankar B00800573	
- Yash Modi B00799125
- Babatunde Adeniyi B00792158 	
- Utsav Soni B00812689
- Abhishek Rajkumar B00806870

********************************************************************************************************************************************************************************
The code will be available on github on the link given below:


SSH: git@git.cs.dal.ca:modi/project_group7.git

HTTPS: https://git.cs.dal.ca/modi/project_group7.git


*******************************************************************************************************************************************************************************
Abstract
Internet forums provide common ground or message board to hold conversations, ask questions. Currently, there are different portals for alumni, students, and the professor, and there is very little communication between them. Dal Connect intends to merge all portals into a single platform. Dal Connect is a platform for students, alumni and faculty members of Dalhousie University, where they can hold conversations in the form of posted messages, share knowledge, learn, and build their careers.

Motivation
The application is intended to help the students, professors and alumnis to connect with others. It is also a way for administration to know students' problem and help them out.  

Requirements
This module requires the following modules/libraries:

* mysql
* php server 

 Frameworks

To develop the project the below mentioned frameworks have been used

Front End Frameworks**


Bootstrap - Bootstrap provides an easy to use framework along with HTML, CSS and Javascript. It is used to develop responsive websites. Bootstrap 4 has been used in the project

HTML- The page layout has been designed by making use of HTML

CSS - The page design and animations are done using CSS

JavaScript- JavaScript has been used for validating the user content and making the website dynamic
JQuery - JQuery has been used for event handling and making ajax request for form submission

Back End Framework

CodeIgnite- CodeIgniter is an open-source software rapid development web framework, for use in building dynamic web sites with PHP.

php - php is one of the most famous and powerful backend scripting language. We're also using codeigniter to accomplish this project but this assignment only contains php files. 

Database
mysql - Mysql is used as databse engine for this project.


Libraries
 FontAwesome - FontAwesome has been used for displaying different icons. Font awesome is a popular website that provides free icon sets for websites. The icons are licensed under the Creative Commons Attribution 4.0 International license. We use these icons for the buttons on the application. Source [here](https://fontawesome.com/icons?d=gallery)

Folder Structure
CodeIgniter directory structure is divided into 3 folders −
Application
System
User_guide
1. Application
As the name indicates the Application folder contains all the code of for the application being built.

Cache: This folder contains all the cached pages of the application. These cached pages will increase the overall speed of accessing the pages.
Config: This folder contains various files to configure the application. With the help of config.php file, user can configure the application. Using database.php file, user can configure the database of the application. 
Controllers: This folder holds the controllers of your application. It is the basic part of your application.
Core: This folder will contain base class of your application.
Helpers: In this folder, you can put helper class of your application.
Hooks: The files in this folder provide a means to tap into and modify the inner workings of the framework without hacking the core files.
Language: This folder contains language related files.
Libraries: This folder contains files of the libraries developed for your application.
Logs: This folder contains files related to the log of the system.
Models: The database login will be placed in this folder.
Third_party: In this folder, you can place any plugins, which will be used for your application.
Views: Application’s HTML files will be placed in this folder.

2.System
This folder contains CodeIgniter core codes, libraries, helpers and other files, which help make the coding easy.

Core:This folder contains CodeIgniter’s core class. Do not modify anything here. 
Database:The database folder contains core database drivers and other database utilities.
Fonts:The fonts folder contains font related information and utilities.
Helpers:The helpers folder contains standard CodeIgniter helpers (such as date, cookie, and URL helpers).
Language:The language folder contains language files.
Libraries:The libraries folder contains standard CodeIgniter libraries (to help with e-mail, calendars, file uploads, and more). Own libraries can be created or extended.

 Database Structure
Posts: It has posts detials.  
Users: It has id, username and password. Used to validate user.
Users_detials: It has all user details connected through user id.

Installation Notes
Kindly perform the below steps to run the code:

1) Run the command 'git clone https://git.cs.dal.ca/modi/dalcommunityforum.git'.
2) Import the code in any Apache, MySQL server (i.e WAMP Server).
3) Import .sql file from the main directory to the MySQL server.
4) Open folder containing project, go to dalconnect/application/config.php and change the base url according to need.
5) Also change the database credentials according to your one in dalconnect/application/database.php
6) Run that url into web browser.



Feature Section
1. Creating Posts
&nbsp;Consists of a module where users’ need to enter all the details regarding the post. Mainly it’ll ask for the title of the post, its description, and the tags it comes under. Posting the queries, questions, and concerns to the forum. 

2. Searching Posts
&nbsp;It consists of a search module which will help user search throughout the forum using keywords; it is a great way to reach posts easily. 

3. Commenting on Posts
&nbsp;Commenting will allow other users to share their views regarding some post. Every user will be able to put their insight into a thought. 

4. Upvoting & Downvoting Posts
&nbsp;This module will consist of a part where anyone who is in support of the post can upvote (support) that post and who doesn’t tend to think the same can downvote the post. This module will have the facility to prioritize questions, queries or concerns according to their votes. Posts containing problems of students and having the highest votes will be directly sent to the administration. That way students’ problems can reach higher authorities. 

5.User Profile Management (Manipulate Posts, Demographic Info)
&nbsp;This feature allows a user to have a look at their previous posts, change or edit their personal details like name, username, password, profile image and so on. Users can also look at the responses on their previous posts. It also consists of a system which distinguishes between the professor, students, alumni, and administration. 

6. Report Inappropriate / Spamming Posts
&nbsp;Dalhousie campus is shared by multicultural and multiethnic students and professors. It consists of a facility to report inappropriate things to the admin. Posts that have abusive words or content that harm any community’s values, or anyone’s personal feelings can be reported and removed from the forum. There are also possibilities of someone creating spamming content on such platforms. That also can be reported and ultimately removed from the forum.   

7.Admin Panel
&nbsp;The first feature provides some form of moderation to the platform, to ensure users conform to the guidelines and goals of the platform. It is only accessible by users with administration rights. A user who is responsible for managing everything on the forum. The admin performs operations such as removing inappropriate or spamming content, giving permissions to users, ensuring communication with the administration. This feature would ensure sanity and ensure quality on the platform.

8. Categories
&nbsp;This feature allows the post to a certain topic under one heading. So, this feature will allow the posts to be viewed by only the members who are authorized to view a post. For example, a post created in computer science category can be only viewed by those who are associated with computer science. 

9. Notifications
&nbsp;This module will notify the user or admin of an event. For example, if a user has commented on a post, then the creator of the post will be notified that a user has commented/replied to his/her question. Similarly, the admin will be notified of spam or abusive content of a post using this functionality.

10. Contact us & About Us
&nbsp;This feature allows the user to connect to the admin for non-standard issues


Project Status
We have completed 100% of the project. Some bugs have been identified during testing and we are currently resolving them. We are also enhancing the UI to make it more intuitive. All the functionalities that were promised in project assignments have been successfully completed. The future scope of this project will be to implement automatic admin side and deploying for the community.

References

1) https://www.w3schools.com/howto/howto_css_dropdown_navbar.asp
2) https://www.w3schools.com/css/css_dropdowns.asp
3) https://www.quora.com/How-do-I-override-a-Bootstrap-CSS-style
4) https://bootsnipp.com/tags/card
5) https://www.w3schools.com/bootstrap4/bootstrap_cards.asp
6) https://getbootstrap.com/docs/4.0/components/card/
7) https://getbootstrap.com/docs/4.0/components/forms/
8) https://www.pair.com/support/kb/how-to-customize-your-bootstrap-form/
9) https://www.w3schools.com/howto/howto_css_responsive_form.asp
10) https://uxplanet.org/how-to-customize-bootstrap-b8078a011203
11) https://bootstrapbay.com/blog/bootstrap-button-styles/

* icons: 
https://www.dal.ca/

* images:
Dalhousie images:
https://www.dal.ca/

 Credits

- Botstrap - http://getbootstrap.com
- Font Awesome 5 - https://fontawesome.com/ 




