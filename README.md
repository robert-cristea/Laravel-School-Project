-   ### I have added a field into 6 different tables ... so I need to add the field into the forms related to each table.

### For the following tables, I have added a field called: user_level

The meaning of it is that we need to know which user_type should have access to each tool .. ( we have 9 types of users, for example free_user, premium_user, corporate_user ..etc.)
That means for 4 tables I have added the same field called user_level

-   self_hypnosis,
-   guided_meditation,
-   breathing_tool,
-   mindfulness_tool

-   The next table is corporate_client_settings .. I have added there a field called "hours" ... that means each corporate_cleint has
    an amount of hours to be consumed.
    corporate_client_settings

-   the next table and the last one is video_lessons_settings .. i have added a field there called "order_number" .. the field is to
    define in which order we will display the video_lessons.
    video_lessons_settings

-   we have a table where I have added more than 3 fields .. it's the table: coaching_reports table.
    I think these are: coach_name, user_first_name, user_last_name, user_email, duration, etc.
    coaching_reports

-   ### Generating the validation key is already implemented by Eirini, the import function for the coaching_report is also already implemented .. we need simply to display the content of the important data as table so that the superadmin can apply any CRUD functionality there

the import function is implemented by me into the script you have already.
Asked sample csv file
Import csv file
Redirect to table page
Display the coaching_report as a table (customize the coaching page, table)

-   Based on the queries we have build till now ( please check the analytics-page of the dashboard) we need to generate charts and we need to generate pdf-file based on the created charts .. i have added some samples into the script you have now ...i can send you a samples how the charts should look like .. you can use charts.js or d3.js .. or whatever you want

General Tab
Per Client Tab
Per User Tab
Coaching report chart

-   ### The next is very easy ... we have a table called challenges ... we need to create a form for challenges so that the superadmin can add/edit/delete any challenge ... after it's done we need to assign a challenge to each video_lesson .. as you know we assign to each video_lesson a quiz ( need also to be implemented, I have already created 2 tables for that) , we assign also to a video_lesson a challenge .. we need to implement that ..
