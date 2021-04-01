# CS476--FinalProject
## Queen City's Gambit - A community driven tabletop game review site for the city of Regina, Saskatchewan
This web application was developed with the tabletop gaming community of Regina in mind. Due to COVID-19 many of the places where people could once meet and play games together are either no longer open due to financial restrictions or would violate current laws regarding private gatherings. This web application aims to provide a space where people can learn about other games and read local reviews on them without having to purchase a game themselves. This can be accomplished by the search function of the website, where anyone can browse through approved games as well as other users. Anyone can join the site freely and once the signup is complete; they can post reviews for existing games without moderation. However, game descriptions posted by any user must be approved by an admin before appearing on the site. In order to become an admin, a user must be promoted by an already existing admin. Admins are able to complete the same tasks as a community user, but they have the added responsibility of being able to review flagged reviews as well as approve or deny game descriptions that are up for moderation. 

## Index
The index page is the first page that anyone will see when visiting the website. This page shows a predefined featured game, a list of all approved games, as well as navigation buttons to get around the rest of the site (Search, Signup, and Login are the only options available to someone who is not already logged in). A user who is logged in will have different navigation buttons which better reflect what they can do on the site; instead of signup there is a button which brings the user to their dashboard and instead of login there is a button to logout. 

![image](https://user-images.githubusercontent.com/54295544/113227410-e101df00-924f-11eb-98ee-5f3172579dd0.png)

## View Tabletop Game
On the index page, anyone can click the links on the game cards to bring them to a page that displays this game. This page features information regarding the game itself, any photos which have been uploaded as well as any reviews that have been left by other users. The buttons we see on this page – to leave a review or flag a review – can only be accessed by someone who is at least a community user, when a visitor clicks on one of these buttons, they are brought to the login page to remind them to login before trying to complete this action. 

![image](https://user-images.githubusercontent.com/54295544/113227446-f414af00-924f-11eb-9fab-20b6c8659e0e.png)

## Search
The search page allows anyone to look through the profiles and games which have been added to the website. The query should be typed into the search bar and the type of query be selected by clicking on USER and/or GAME. The results will depend on the query and will be displayed below the search bar. The results are determined by any word used to describe the user and/or the game but not those used in the biography or game description text area. For example, you can search for someone by screenname, real name, email, etc. The navigation bar at the top allows the user to continue to navigate the website. 

![image](https://user-images.githubusercontent.com/54295544/113227471-01ca3480-9250-11eb-871b-d7d6b5d26b1f.png)

## Signup
Any user who is not logged in has the option to signup. They can do this by selecting ‘Signup’ from the navigation bar. This brings them to the signup page where they can enter their information in order to create a community user account on the website. This form has both front and back-end validation. The front-end validation uses JavaScript to check the inputs and prevent submission of the form if there are any errors present. If JavaScript is disabled or it is something that the JavaScript cannot account for, then there is also server-side validation that ensures that these inputs still cannot be passed to the database. 

![image](https://user-images.githubusercontent.com/54295544/113227511-14dd0480-9250-11eb-8568-676107ed8e87.png)

Rules for submission:
1.	No input, other than biography and the profile picture, may be left blank.
2.	Neither first nor last name may exceed 25 characters.
3.	Email must match the standard email format and be no more than 320 characters
4.	Screenname must be less than 50 characters.
5.	The password must be between 8 and 25 characters. It must include at least one uppercase, one lowercase, one number, and one  special character.
6.	Favourite game must not exceed 60 characters.
7.	The biography must not exceed 500 characters.
8.	The image must be less than 2MB and must be of a valid filetype.

## Login
Anyone who is using the site who is not already logged in will also have access to the login button. Pressing this will bring the user to the login page. Here they can submit their profile information and log in. An admin and Community user will have the same login page and requirements for the login to be valid. When a user successfully submits the signup form, they are brought to the login page as well (hopefully to enter their new credentials).
The inputs on the login page are validated on the front and back-end. The front-end components (JavaScript) ensure that the inputs are valid to what is required – that an email has the proper structure of an email and that the password has the proper structure of a password. On the back-end, these inputs are used to make sure the user has a valid login and that the credentials match those which are already on the site (allowing them to login as the user who’s information they have provided).  

![image](https://user-images.githubusercontent.com/54295544/113227717-9339a680-9250-11eb-9b24-3198022f164b.png)

Rules for submission:
1.	No input can be blank
2.	Email must be of proper email format and less than 320 characters.
3.	Password must contain at least one uppercase, one lowercase, one number, and one special character. 
4.	The provided input must match the credentials of a user on the site (back-end).

## Dashboard
Once logged in, the user, regardless of their status as an admin, will be brought to their dashboard. This is very similar for both community users as well as admins. We get a welcome message, the last date the user logged in, all the information they provided in their signup form, and button to edit their profile. The next section shows a button to submit a game description as well as the games that the user has submitted and the status of their approval. An admin has an additional area called the ‘Administrator Area’. Here we see any reviews that have been flagged for review by another user as well any game descriptions that have been submitted by another user. These tasks are removed as they are dealt with. 

![image](https://user-images.githubusercontent.com/54295544/113227753-a5b3e000-9250-11eb-8f2d-5966cec14660.png)

## Edit Profile
Clicking the edit profile button on the user’s dashboard brings the user to the edit profile page. This page is very similar to the signup page except it is already filled with the information the user has already provided when they signed up. The user can change every aspect of their profile through this page. It is not necessary to reupload the profile photo nor to enter/confirm the password as long as the user does not wish to change these. Unlike in signup, there are two buttons at the bottom, one allows the user to submit the changes they’ve made and update their profile and the other allows the user to delete their account (an action which cannot be undone). Both of these options are confirmed via popup boxes to help make sure nothing gets changed or deleted accidentally. To discard changes, simply leave the page without pressing either button. 

![image](https://user-images.githubusercontent.com/54295544/113227794-b9f7dd00-9250-11eb-992e-a347a9d4c860.png)

Rules for submission:
1.	No input, other than biography, profile picture, and passwords may be left blank.
2.	Neither first nor last name may exceed 25 characters.
3.	Email must match the standard email format and be no more than 320 characters
4.	Screenname must be less than 50 characters.
5.	The password must be between 8 and 25 characters. It must include at least one uppercase, one lowercase, one number, and one special character (if changed).
6.	Favourite game must not exceed 60 characters.
7.	The biography must not exceed 500 characters.
8.	The image must be less than 2MB and must be of a valid filetype (if changed).

## Submit A Tabletop Game
The next option available from any user’s dashboard is the button to submit a tabletop game to the site. This allows the user to give details of a game of their choice to be uploaded to the website. These submissions are moderated for quality by the admins. In order to submit multiple photos, they must be selected all in one go. 

![image](https://user-images.githubusercontent.com/54295544/113227831-cf6d0700-9250-11eb-833e-d5a2921dd6ec.png)

Rules for Submission:
1.	No field may be left blank.
2.	Game title may not exceed 60 characters.
3.	Company name must be less than 100 characters. 
4.	Maximum number of players may not exceed 20.
5.	Age rating may not exceed 19+.
6.	Number of expansions may not exceed 30. 
7.	Image must be of a valid format and may not exceed 2MB in size. 

## Review A Flag
As an admin, the administration area can be used to approve or deny certain requests. If a review has been flagged, the admin can go to the review flag page and either approve the review or delete via two buttons at the bottom of what is otherwise the view tabletop game page, this is confirmed via a pop-up box. No feedback is necessary for this.

![image](https://user-images.githubusercontent.com/54295544/113227867-e27fd700-9250-11eb-9f20-559d018b8950.png)

## Review Game Descriptions
An admin can also approve or reject game descriptions that have been proposed to be added to the site. Feedback must be given either way and should include either what the user did that was good and bad. This will not only provide them reason for why they were denied/approved, but also help the user to improve any future content that they decide to post to the website. 

![image](https://user-images.githubusercontent.com/54295544/113227894-f0355c80-9250-11eb-81fc-b2c2f8eb4f99.png)

## View User
From the search page, if a user is to search for another user, they can click on their result and be brought to the view profile page. The view profile page is very similar to the dashboard of a community user with the exception of the edit profile button as well as the list of games that the user has submitted (or the option to submit a new game). A community user will be able to see any information that any other user has made public as will an admin. However, if the user viewing the profile is an admin there are two more buttons than there are for a normal community user – ‘delete’ and ‘promote’. Delete does what the name implies – it deletes the user from the website. The other option is to promote the user, this changes the user from a normal community user into an admin – giving them all of the abilities of the person who just promoted them. Like on other pages, there are confirmation boxes which allow the person clicking the button to be sure of their selection before it cannot be undone by them. 

![image](https://user-images.githubusercontent.com/54295544/113227934-0216ff80-9251-11eb-95a2-b0a94cd9e094.png)
