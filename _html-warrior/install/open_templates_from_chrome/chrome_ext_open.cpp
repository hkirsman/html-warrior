#include <stdio.h>
#include <stdlib.h>

#include <iostream>
using std::cerr;
using std::cout;
using std::endl;
#include <fstream>
using std::ifstream;
#include <cstdlib> // for exit function
// This program reads values from the file 'example.dat'
// and echoes them to the display until a negative value
// is read.


using namespace std;

int main ()
{
    ifstream indata; // indata is like cin
    char num; // variable for input value
    indata.open("chrome.txt"); // opens the file
    if(!indata) { // file couldn't be opened
        cerr << "Error: file could not be opened" << endl;
        exit(1);
    }
  indata >> num;
   while ( !indata.eof() ) { // keep reading until end-of-file
      cout << "The next number is " << num << endl;
      indata >> num; // sets EOF flag if no value found
   }
   indata.close();
   cout << "End-of-file reached.." << endl;
   	
    //system("start c:\\Progra~1\\EditPl~1\\editplus.exe e:\\www\\liitu\\templates\\pages\\fboxAddPartner.tpl");
    system ("pause");
    return 0;
}
