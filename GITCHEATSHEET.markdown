GIT cheat sheet
==============

git add .  
Add modified and new files

Undo add  
git rm -r --cached .

git commit  
commit to local repository (only staged files)

git commit -a  
commit to local repository (automatically stage tracked files)

git gommit origin master  
commit to github

git reset --hard HEAD  
reset to last commit ( does not delete non-versioned directories thank god :) )  

git diff --check  
Check if files about the committed don't have trailing white-space  

git config --list  
Checking Your Settings

git help config  
Git help example

Changing Your Last Commit  
git commit --amend

git checkout -- <file>  
Unmodifying a Modified File. Example git checkout -- benchmarks.rb. git status tells that too.

git tag -a v1.4 -m 'my version 1.4'  
Add annotated tags

git push origin v1.4  
Transfter tag to server

git push origin --tags  
Transfer all tags to server

git push origin :imageoverlay  
Delete remote branch named imageoverlay. It will push nothing to imageoverlay branch and thus deletes it

git reset HEAD^ --hard  
git push mathnet -f  
Remove/revert the last commit

git checkout -b iss53  
Create branch for iss53. Another point is how to branch issues in a short name.

git checkout master  
git merge hotfix  
Merge hotfix branch with master