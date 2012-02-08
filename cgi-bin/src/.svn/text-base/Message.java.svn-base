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
import java.io.*;
import org.jdom.*;
import org.jdom.input.SAXBuilder;
import org.jdom.output.Format;
import org.jdom.output.XMLOutputter;
import java.lang.String;
import java.net.URLDecoder;
import java.text.ParseException;

public class Message
{
    private static org.jdom.Document document;
    private static Element root;
    private String macAddress;
    private String ipAddress;
    private String messageID;
    private static Element answerRoot = new Element("message");
    private static org.jdom.Document answerDocument = new Document(answerRoot);
    
    private void getRequestFromXML()
    {
	try {
	    messageID = ((Element)(root.getChildren("messageID").toArray()[0])).getText();
	    macAddress = ((Element)(root.getChildren("MACAddress").toArray()[0])).getText();
	    ipAddress = ((Element)(root.getChildren("IPAddress").toArray()[0])).getText();
	}	      
	catch (Exception e) {
	    errorMessage("Missing or bad arguments");
	}
	//System.out.println("Requet recue :\nMACAddress = " + macAddress + "\nIPAddress = " + ipAddress + "\nmessageID = " + messageID);
    }
    
    public void errorMessage(String description)
    {
	Element resultBool = new Element("resultBool");
	Element resultDescription = new Element("resultDescription");
	resultBool.setText("false");
	resultDescription.setText("Execution failed : " + description);		      
	answerRoot.addContent(resultBool);
	answerRoot.addContent(resultDescription);
	displayXML(answerDocument);
	System.exit(-1);
    }

    public void errorMessage(String IDmsg, String description)
    {
	Element msgID = new Element("executedMsgID");
	msgID.setText(IDmsg);
	answerRoot.addContent(msgID);
	Element resultBool = new Element("resultBool");
	Element resultDescription = new Element("resultDescription");
	resultBool.setText("false");
	resultDescription.setText("Execution failed : " + description);		      
	answerRoot.addContent(resultBool);
	answerRoot.addContent(resultDescription);
	displayXML(answerDocument);
	System.exit(-1);
    }
	  
    private void addNewClientMessage(DatabaseInterface db)
    {
		Element msgID = new Element("executedMsgID");
		Element resultBool = new Element("resultBool");
		Element resultDescription = new Element("resultDescription");
	
	    db.addNewClient(ipAddress, ipAddress, 1, 0, macAddress, this);
	    msgID.setText("1");
	    answerRoot.addContent(msgID);
	    resultBool.setText("true");			  
	    resultDescription.setText("Your request was successfully executed");			  
	
		answerRoot.addContent(resultBool);
		answerRoot.addContent(resultDescription);
		displayXML(answerDocument);
    }
    
    private String getAction(int action)
    {
    	 if (action == 2)
         	return ("sleep");			  
         else if (action == 0)
         	return ("poweroff");
    	 return ("nothing");
    }
    
    private void getPlannedAction(DatabaseInterface db) throws NumberFormatException, ParseException
    {
    	int action = 0;
    	try {
    		action = db.getPlanning(ipAddress, macAddress, this);
    	} catch (Exception e) { errorMessage("2", "Unable to get planned action"); }
    	Element msgID = new Element("executedMsgID");
    	Element resultBool = new Element("resultBool");
    	Element resultDescription = new Element("resultDescription");
    	Element auditMode = new Element("auditMode");
    	Element nextRequest = new Element("nextRequest");
        msgID.setText("2");
        answerRoot.addContent(msgID);
        resultBool.setText("true");
        resultDescription.setText(getAction(action));
        auditMode.setText(db.isAuditMode());
        nextRequest.setText(db.getNextRequest());
    	answerRoot.addContent(resultBool);
    	answerRoot.addContent(resultDescription);
    	answerRoot.addContent(auditMode);
    	answerRoot.addContent(nextRequest);
    	displayXML(answerDocument);
   }
    
    public void displayXML(Document mydoc)
    {
	try {
	    XMLOutputter sortie = new XMLOutputter(Format.getPrettyFormat());
	    sortie.output(mydoc, System.out);
	}
	catch (java.io.IOException e) {
		System.out.println("Execution failed : Error during XML answer generation");
	}
    }
    
    public void analyse(DatabaseInterface db, String message) throws NumberFormatException, ParseException
    {
	SAXBuilder sxb = new SAXBuilder();
	try {
	    document = sxb.build(new StringReader(URLDecoder.decode(message)));
	}
	catch(Exception e) {
	    errorMessage("Bad XML Request");
	}
	root = document.getRootElement();
	getRequestFromXML();
	if (db.dbConnect() == null)
		errorMessage(messageID, "Error while connecting to the Database");
	else if (messageID.equals("1"))
	    addNewClientMessage(db);
	else if (messageID.equals("2"))
		getPlannedAction(db);
	db.dbClose();
    }
    
}
