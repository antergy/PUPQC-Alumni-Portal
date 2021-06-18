#### Requirements for Account Management (Alumni)

---

- An alumni can register (create) his/her account though registration form.
- An alumni can view his/her personal account details.
- An alumni can update his/her personal details.


#### Requirements for tracer form

---

- Check the following navigation in chronological order:
(Note: These pages are not functional;)
1. Go to http://pupqc.alumni-portal.com
2. Click "register now"
3. Click "Create account"

   Assuming the alumni has succeeded to register for an account, he/she can skip (redirected to homepage), or go to tracer form
4. Before selecting the "Go to tracer form" option, he/she must select on which degree he/she last graduated as a PUP alumni. 
   (Create also a method for this, under Controller/Front/RegistrationPageController.php, and create a separate service and library: SystemAdminService & DegreeMgtLib)
   
5. By selecting the program on the top of the form, this will change the current form displayed in the UI
   (For now, MSIT tracer form is displayed, but in default it's blank until selection)
   
6. The logic for displaying tracer form layout is implemented 
   (Refer to our previous discussion about this)

Additional requirements:
- The admin can create/view/update/delete form related entities, which includes:
  - Question group
  - Question type
  - Questions
  - Answers
  - Choices
  - Main form setup
