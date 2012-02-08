/*
This file is part of Ecoparc project.
 
    Ecoparc project is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
 
    Ecoparc project is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with Ecoparc project.  If not, see <http://www.gnu.org/licenses/>.
*/
import java.util.*;
import java.io.*;
import java.lang.Object;
import java.net.URLDecoder;
import java.text.ParseException;

// DEBIAN
public class Ecoparc
{
	private DatabaseInterface db;
	
	private void run(String message) throws NumberFormatException, ParseException
	{	
	    db = new DatabaseInterface(true);
	    Message msg = new Message();
	    msg.analyse(db, message);
	}
	
	public static void main(String[] args) throws NumberFormatException, ParseException
	{
		Hashtable form_data = cgi_lib.ReadParse(System.in);
	    //Hashtable form_data = cgi_lib.ReadParse(args[1]);
	    //String message = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><message><MACAddress>00:11:18:5b:3a:1f</MACAddress><IPAddress>192.168.1.1</IPAddress><messageID>2</messageID></message>";
	    //String message = args[1];
	    String message = (String)form_data.get("message");
		Ecoparc EIP = new Ecoparc();
	    EIP.run(message);//args[0]);
	}

}

/*public class Ecoparc
{
	private DatabaseInterface db;
	
	private void run(String message) throws NumberFormatException, ParseException
	{	
	    db = new DatabaseInterface(true);
	    Message msg = new Message();
	    msg.analyse(db, message);
	}
	
	public static void main(String[] args) throws NumberFormatException, ParseException
	{
		//Hashtable form_data = cgi_lib.ReadParse(System.in);
	    //Hashtable form_data = cgi_lib.ReadParse(args[1]);
	    //String message = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><message><MACAddress>00:11:18:5b:3a:1f</MACAddress><IPAddress>192.168.1.1</IPAddress><messageID>2</messageID></message>";
	    //String message = args[1];

	    //String message = (String)form_data.get("message");
		Ecoparc EIP = new Ecoparc();
	    EIP.run(args[0]);
	}

}*/
