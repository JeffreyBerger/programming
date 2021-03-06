<?php include "header.php";?>


    <div class="container">

      <div class="jumbotron">
        <h1>GIT</h1>
        <h3>We are going to setup GIT, setup GITHUB, and learn to use it a bit.</h3>
        
        <h3>Pre-reqs : None (for most of it), <a href="apache1.php">Apache</a>(for all of it)</h3>
               
        <h3>What is GIT?</h3>

        <p>Git is a version control software, and what this does is it allows collaboration on a software project in ernest.  Josh Kat and I have already run into issues with having a single code base that we are all editing, not only can we not edit the same file at the same time but sometimes one of us working on a feature ( me working on the login, and thusly breaking the login for the website) will stop someone else from working on their feature ( such as Kat who needs to be logged in to see the changes to the page she is working on).  This problem only gets tremedously worse as we scale up and becomes impossible once we have the project live and we need to be able to edit code and test it incrementally before making it live.</p>

		<p>What Git does is that it will allow us to have our code saved after each change of the code base (these changes are called commits because it is not saved after every change, it is only saved into the git database when you issue a commit command to the file, saying that your block of changes are done and it should remember this version of the file.  There is no limit to how many times you may commit a file and as space is super cheap don't worry about the overhead on the hard drive of these files).  With these commits we can rewind our changes, and that alone seems useful.  But there is a lot more that we can do.</p>

		<p>Git allows us to branch off from the main code base and work in a detatched parallel manner.  The way you should think of it is that there is one batch of code called 'master', this is what our website runs off of.  We don't want to mess with this until we know things are working.  So Jeff Josh and Kat each make a branch (we'll call them Jeff Josh and Kat) because they are all working on different things.  Jeff could work on his feature, and then 'merge' these changes into the master branch.  Josh could merge his feature in then as well.  Even if the same file has been modified Git will merge the changes in the files - if the program cannot tell about the merges then it will issue a conflict and we will deal with it manually but this will be much less of an issue than you think.  If Kat is still working on her features on her branch she can pull from the master to get the features from the master branch into her branch and continue working without losing the code she is working on (It is a good idea to regularly pull from the main development branch).</p>

		<p>Yes it is a bit weird to get your head around but it works very well, and it is very clear to see that we can't all be working on the same code base at the same time.</p>

		<h3>GITHUB</h3>

		<p>First order of business is to go to <a href="www.github.com">github</a> and make an account on github.  Put in your email and verify it, there is a github boot camp which 
		will help you get started.  You need to install your github account locally (yes on your machine, not on your AWS, we'll get to that later.), there are good instructions on there for all operating systems so windows users should not fear.  If you are in linux or mac it will install git so you can access it from the terminal, if you are in windows then it will install a git bash program for you to use.  You also need to follow the instructions to get a ssh key and add it to your account.  Once you have an account we can begin.</p>

		<p>We'll need to do some setup of the installation, this should help you out.  You'll need to configure your username and email with GIT after the install if you haven't already.  All these commands are the same in a git bash terminal on windows or on the normal terminal in AWS.</p>
		<code>
			<p>git config --global user.name YOUR-GIT-USERNAME</p>
			<p>git config --global user.email YOUR-GIT-EMAIL</p>
		</code>

		<p>You also need to make a SSH key for this user.  For this we'll use the ssh keygen command.</p>
		<code>
			<p>ssh-keygen</p>
		</code>

		<p>Don't specify a filename (it'll use the system default) and don't specify a password for the SSH file (you can if you want but it is annoying as hell).  Finally we need to add the public key to our account, as the keygen produced a private key (which should never leave our computer) and a public key (which we give to those who we want to authenticate with).</p>

		<img src="img/GIT1/git15b.png" width="1050"/>

		<p>We need to add the public key to our account so first output the public key to the screen so we can copy and paste it.  This command will output the ssh public key to the terminal so you can highlight the whole thing and paste it into your account settings on Github.</p>

		<code>
			<p>cat ~/.ssh/id_rsa.pub</p>
		</code>

		<img src="img/GIT1/git16.png" width="1050"/>

		<p>Go to your account settings (upper right corner) and ssh keys (left nav bar) and add it by pasting it into the box on the webpage.</p>

		<img src="img/GIT1/git17.png" width="1050"/>

		<p>Now we are going to get you some code to work on, open up your terminal / or the git bash depending on your system.  Navigate to the folder that you want to have your code base in.  I put mine in ~/Documents/repos, if you want you can make the folder with mkdir (the bash terminal accepts standard terminal commands like mkdir cd and such).  I will be using the bash terminal and assuming most of you roll windows - if you are on a mac or a linux box you are expected to open a terminal and keep pace!</p>

		<p>Next we are going to download a code base.  We're actually going to use this site as our code base.  To copy a codebase (called a repository, or a repo), we'll want to do what is called a git clone.  The command is "git clone REPO" where our repo will be git@github.com:JeffreyBerger/programming.git .  This will create a folder called "programming" in your current directory and put the code-base in there.  In the GIT bash on windows you can't ctrl-v or right click to paste you need to hit the insert buttton or in the upper left corner click the icon and go to edit.</p>

		<code>
			<p>git clone git@github.com:JeffreyBerger/programming.git </p>
		</code>

		<img src="img/GIT1/git1.png" width="1050"/>

		<p>Now go into the folder programming and you'll find all the code for our programming site and you can now modify it.  There is a readme.md file in there, why don't you open it and append to the file a line that says "YOURNAME has been here".  Notice how I am using a text editor, not vi or a special program.  GIT has put the files from the programming repo locally on your machine.  Literally they are all text files in a folder on your computer and you should go with your favorite text editor and edit the files where they sit on your hard drive, there is no need to go through GIT to do these edits.  For light files like this (heavy ones might be a large C++ or Java program, for those you often want a larger development suite such as Eclipse provides) I usually go with <a href="http://www.flos-freeware.ch/notepad2.html" target="blank">notepad2</a>, <a href="http://notepad-plus-plus.org/">notepad++</a> or sublime text <a href="http://www.sublimetext.com/" target="blank">sublime text</a>.  I've been moving over to using sublime lately it is very good, even if it does bother you about the trial period sometimes.  I won't discuss notepad2 or notepad+ because they are pretty self explanatory, open the file with them.  Sublime has some more machinery so I'm going to go over a quick setup.  Both Eclipse and Sublime are cross platform, so you can use them on whatever system you'd like.</p>
		
		<hr/>
		<p>SIDENOTE : Sublime Setup.  The easiest way I've found to setup sublime is to simply go to "Project" and "add folder to project" and choose either your Documents or your repos folder (or whatever folder has your code in it).  You'll see in the left a bar will appear with folders and you can nav now through all of your files and edit them.  There is a lot of power that sublime has and I'm not really knowledgeable in it yet but it is pretty sweet and you might want to start using it.  Since it is cross plat you can have it on whatever systems you own (I've got the exact same setup on my mac and my pc).</p>
		<hr/>
  
        <img src="img/GIT1/git2.png" width="1050"/>

        <img src="img/GIT1/git2b.png" width="1050"/>

		<p>With the file edited we need to register with GIT that we are done editing the file and it should record the changes.  This action is called a 'commit' as you are commiting the files to the GIT database.  You are only commiting it to your LOCAL GIT database, you are not contacting the server sitting on GITHUB yet.  This means all your changes are recorded locally and that makes them very fast, and accessed without an internet connection.  To commit a file you need to run the following command in the git bash (or terminal).  </p>

		<code>
			<p>git commit README.md -m "YOURNAME first change</p>
		</code>

		<p>The message flag (-m) associates a message with the commit to describe what has happened in this change.  If you do not put the mesage a file will open that will force you to put a message - it'll open it in the default editor (which is probably vi) and require you to enter something before the commit is taken.  If you don't put anything it will cancel the commit.  Now you have committed a file, lets make a new one and add it.  In that folder create a new text file and call it "YOURNAME.txt" and put some text in it and save it.  We'll try and commit that too now.  Run a commit command on your new text file.  Notice the error?  Ok what happened is that you need to add it to the database first before updating it with a commit command.  Adding it tells git to keep track of this file.  To add it to GIT tracking then use the following command</p>

		<code>
			<p>git add YOURNAME.txt</p>
		</code>

		<p>Note that adding a file does not need a comment, only committing a file.  Now that it is added to GIT control you can run your commit and it will work.  Tada!</p>

		<img src="img/GIT1/git3.png" width="1050"/>

		<p>We've updated our code on our local machine but the server does not have the changes.  To put these changes on the server we must do what is called a 'push' and make our changes merged with the server.  This is easy, all you need to do is the following command</p>

		<code>
			<p>git push origin master</p>
		</code>

		<p>NOTE: you need to tell me your github user name so I can add you as a collaborator to this repository or you will have read-only access and not be able to push to the repository!  This tells git to put the updates to the origin remote repository under the branch of master.  We'll describe the master branch stuff next, the origin is set by default when you go into a repository folder as the location that you cloned the repo from.  Once the push is done then you will want to check that it worked, go to github and go the repository and see if your changes have appeared on github, which they should have.  NOTE : if you recieve an error that your code is out of date that is because someone else changed the master code while you were working and you must have the most up to date code.  You should execute a "git pull" to get the latest and then push your changes.  Even if they edited the same file you should be able to have your changes merged with theirs with no problem.  If you have further problems you should email the group and we can peice an answer together or just google it.</p>

		<img src="img/GIT1/git4.png" width="1050"/>

		<img src="img/GIT1/git5.png" width="1050"/>

		<p>As I was saying, if someone modified the master branch while you were doing stuff then you'll have a conflict.  Also the master branch is usually just for tested code, not for any willy-nilly code.  So what everyone uses are branches.  Branches are alternative paths of development that can occur in parallel with other changes.  You only care about changes on your own branch, so if we make a branch then we can change code in peace without worrying about code being updated (even if it isn't your code that gets changed a version change might be confusing and unhelpful to your development).  When we are done developing on our branch we will be able to do a merge with the master and blend our changes back in for everyone else to use.  The command to switch branches is the "checkout" command, and the "-b" flag creates a new branch.  Lets make your own personal branch.</p>

		<code>
			<p>git checkout -b YOURNAME001</p>
		</code>

		<p>Now lets add a file, go ahead and make another text file called "MYBRANCH.txt", add it and commit it.  Good.  Now lets push it.</p>

		<code>
			<p>git push origin YOURNAME001</p>
		</code>

		<p>This will create the branch on the server and update your changes.  Now we're going to switch back to the master.  The way we switch back is with the checkout command.</p>

		<code>
			<p>git checkout master</p>
		</code>

		<img src="img/GIT1/git6.png" width="1050"/>

		<p>Go ahead and do an ls of your folder, notice now that the file you created is actually gone from your repository, it isn't that the terminal is hiding it, if you check in your folder structure (windows explorer, finder, whatever) the file has been actually removed.  Because the version of the master branch which is up to date does not include the changes in your branch as these changes have not been merged in with the master.  There is a merge command on git but we are going to do the merge using github and the "pull request" feature on it.  This will request the server to update the master branch with the changes from your branch.  Go to Github and go to the repository and change from the master branch to your personal branch.</p>

		<img src="img/GIT1/git7.png" width="1050"/>

		<p>Now you will find there is a button that says "make pull request", this will send a signal that you want to merge your changes with the master (that you are requesting the master to pull your changes into itself and merge).  Go ahead and make a pull request.  You'll see that it will say that this merge can be done automatically, if a merge has conflicts (two people edit the same part of the same file) then it will force you to resolve those conflicts before merge.  You'll see that at the top we don't have to merge from our branch to the master, we can merge into another branch.  Additionally it will tell you what changes have been made between your version and the version you are merginng into.  We'll want to send the pull request, you can put whatever note in that you want.</p>

		<img src="img/GIT1/git8.png" width="1050"/>

		<p>It is good practice to have someone else on the team check this over before you merge it but lets just press the merge button and move on.  You see that our request is open still and we can make whatever comments we'd like.</p>

		<img src="img/GIT1/git9.png" width="1050"/>

		<p>It'll ask us to confirm the merge and let us put another comment in, but it automatically generates this one which is usually sufficient.  Confirm the merge and all the changes you made in your branch (namely adding that one file) will now occur on the master branch.</p>

		<img src="img/GIT1/git11.png" width="1050"/>

		<p>We can also delete the branch we were just using.  This is just for cleanup so you don't have a billion branches lying around but there isn't a real need to delete your branches, GIT is just happy with thousands of branches so whatever.  Sometimes you don't want to delete the branch and you want to keep working on stuff in parallel which is fine.  Here we're going to delete the branch now that it is merged so go ahead and nuke it.</p>

		<img src="img/GIT1/git12.png" width="1050"/>

		<p>Now lets remove the extra two files from the master.  You can't just delete them on your local machine and expect that git will delete them from the master, you need to run the special git rm command.  So make sure you are in the master branch and up to date.  We make our repository up to date by pulling from it.  This is an easy command</p>
		<code>
			<p>git pull</p>
		</code>

		<p>Now we can remove the file with.</p>
		<code>
			<p> git rm MYBRANCH.txt YOURNAME.txt</p>
		</code>

		<p>Now you'll notice that we're removing both files, might as well clean things up right?  Once you remove them you still have to commit the changes.</p>
		<code>
			<p>git commit MYBRANCH.txt YOURNAME.txt -m "Cleanup"</p>
		</code>
		<p>Now we'll push to the master branch and it'll remove those files from the server</p>
		<code>
			<p>git push origin master</p>
		</code>
		<p>Don't worry about removing these things files, one of the great things with git is that it remembers the changes so if you need to recover anything you can always revert.</p>

		<img src="img/GIT1/git13.png" width="1050"/>

		<p>We are all set up with GIT but lets see how we can use this on a website.  Load up your AWS instance and log in and we're going to install git on it.</p>
		<code>
			<p>sudo yum install git</p>
		</code>

		<img src="img/GIT1/git14.png" width="1050"/>

		<p>You'll also need to configure your username and email with GIT after the install (If this next part looks familiar it is because it is identical!)</p>
		<code>
			<p>git config --global user.name YOUR-GIT-USERNAME</p>
			<p>git config --global user.email YOUR-GIT-EMAIL</p>
		</code>

		<p>You also need to make a SSH key for this user.  For this we'll use the ssh keygen command.</p>
		<code>
			<p>ssh-keygen</p>
		</code>

		<p>Don't specify a filename (it'll use the system default) and don't specify a password for the SSH file (you can if you want but it is annoying as hell).  Finally we need to add the public key to our account, as the keygen produced a private key (which should never leave our computer) and a public key (which we give to those who we want to authenticate with).</p>

		<img src="img/GIT1/git15b.png" width="1050"/>

		<p>We need to add the public key to our account so first output the public key to the screen so we can copy and paste it.  This command will output the ssh public key to the terminal so you can highlight the whole thing and paste it into your account settings on Github.</p>

		<code>
			<p>cat ~/.ssh/id_rsa.pub</p>
		</code>

		<img src="img/GIT1/git16.png" width="1050"/>

		<p>Go to your account settings (upper right corner) and ssh keys (left nav bar) and add it by pasting it into the box on the webpage.</p>

		<img src="img/GIT1/git17.png" width="1050"/>

		<p>We're going to make the repo our site, so go to the folder that is hosting your page and do a git clone of our repository the same as before.  You might see that you do not have access to write to this folder, well no matter we'll sudo this.  And then we run into a strange issue - yes?</p>

		<img src="img/GIT1/git18.png" width="1050"/>

		<p>Let us ponder for a second what is happening.  What you did when you put the ssh key there is that you gave the ssh key to the current user, ec2-user.  When you sudo you basically become root for that command, but root does not have the ssh key, so when you do a sudo command that uses the ssh protocol it doesn't know where the ssh key is.  We can use a command to specify exactly what ssh key it should be using, but instead what is perhaps more reasonable is to let our user have access to the folder that our website is in.  So we will use a chown command on the website folder.</p>

		<code>
			<p>sudo chown ec2-user /home/website</p>
		</code>

		<p>Now we can try the git clone command (without sudo) again.  It might ask you if you want to add this host to your known hosts file and continue, just say yes.</p>

		<img src="img/GIT1/git19.png" width="1050"/>

		<p>Now just go to your browser and go to the YOUR-DNS/programming and you should be able to see a clone of the entire programming website with the tutorials and everything (If you can't access it all from the web remember you need to start apache or you won't serve any HTTP requests!!  Use the script in init.d to start it and if you don't remember check the apache tutorial again).  Oh yeah.  So now you see that we could have a bunch of different people working on code in their branches, when it works they merge it into the master and then we do a git pull to update the website.  We could also modify a file on the server and do a commit and a push from our AWS instance if we want to update something from that side too (The git swings both ways!).  It is possible for your website to actually listen for an update from Github and automatically pull as well, but that is a more advanced function.  Also you don't have to display the master branch as your website, if you want you could use git checkout anotherbranch to host a branch other than master as your site.  You should play around with this but there is a lot of functionality you can get out of this setup especially with multiple people.  You should check out this <a href="http://git-scm.com/book" target="blank">book on git</a> if you want to learn a bunch more about git because it is pretty deep.</p>

		<p>This also means that if you want to put a tutorial up yourself on this site you can, or if you see a typo and want to modify it or add comments at the bottom of the tutorial.  All the code is open to your edits, just follow the same folder and file structure that I am doing now so things can be consistant.  Make a branch, build your tutorial (you can view it on your site the same way you pulled the tutorials here, just instead of checking out the master branch check out your branch), and then when you like it merge the whole thing on Github.</p>

      </div>

    </div> <!-- /container -->

  </body>
</html>
