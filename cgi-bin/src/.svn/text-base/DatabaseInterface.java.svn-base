/* This file is part of Ecoparc project.
 
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
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.sql.*;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.Properties;

public class DatabaseInterface {
	private Connection conn;
	private boolean mysql;
	private String db_user;
	private String db_pwd;
	private String db_name;
	private String db_port;
	private boolean auditMode;
    private String nextRequest;

	public DatabaseInterface(boolean isMysql)
	{
		mysql = isMysql;
		loadConf();
	}
	
	private void loadConf()
	{
		Properties prop = new Properties();
		FileInputStream in = null;
		try {
			in = new FileInputStream("../../../../var/www/config/config.ini");
		} catch (FileNotFoundException e1) {}
		try {
			prop.load(in);
		} catch (IOException e) {}
		try {
			in.close();
		} catch (IOException e) {}
		String db = prop.getProperty("db.adapter");
		db = db.substring(1, db.length() - 1);
		if (db.equals("PDO_SQLITE"))
		{
			mysql = false;
			/*db_name = prop.getProperty("db.params.dbname");
            db_name = db_name.split("\"")[1];*/
			db_name = "../../../../var/www/db/eip_webapp_compiled.db3";
		}
		else
		{
			mysql = true;
			db_user = extractProperty("db.params.username", prop);
            db_pwd = extractProperty("db.params.password", prop);
            db_port = extractProperty("db.params.port", prop);
            db_name = extractProperty("db.params.dbname", prop);
		    }
		try {
			getAuditMode(prop);
		} catch (ParseException e) {e.printStackTrace();}
		nextRequest = extractProperty("srv.nextRequest", prop);
	}
	
	private void insertHeader() throws IOException
	{
		BufferedReader reader = null;
        BufferedWriter writer = null;
        ArrayList list = new ArrayList();
        try {
            reader = new BufferedReader(new FileReader("../../../../var/www/config/config.ini"));
            String tmp;
            while ((tmp = reader.readLine()) != null)
                if (tmp.length() > 0 && tmp.charAt(0) != '#')
                	list.add(tmp);
            reader.close();
            list.add(0, "[general]");
            writer = new BufferedWriter(new FileWriter("../../../../var/www/config/config.ini"));
            for (int i = 0; i < list.size(); i++)
                writer.write(list.get(i) + "\r\n");
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            reader.close();
            writer.close();
        }
	}
	
	private String extractProperty(String name, Properties prop)
	{
		String tmp = prop.getProperty(name);
		if (tmp != null && tmp.charAt(0) == '\"')
			tmp = tmp.substring(1, tmp.length() - 1);
		return tmp;
	}

	private void getAuditMode(Properties prop) throws ParseException
	{
		String audit = prop.getProperty("auditMode");
		if (audit != null && audit.equals("completed"))
			auditMode = false;
		else
			auditMode = Boolean.parseBoolean(audit);
		if (auditMode == true)
		{
			String endDate = prop.getProperty("endDate");
			if (endDate != null)
			{
				 DateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");
				 Date date = (Date)formatter.parse(endDate);
				 Date today = new Date();
				 if (date.before(today))
				 {
					 prop.setProperty("auditMode", "completed");
					 try {prop.store(new FileOutputStream("../../../../var/www/config/config.ini"), null);}
					 catch (FileNotFoundException e) {}
					 catch (IOException e) {}
					 try {insertHeader();}
					 catch (IOException e) {e.printStackTrace();}
					 auditMode = false;
				 }
			}
		}
	}
	
    public String getNextRequest()
    {
    	return (nextRequest);
    }
	
    public boolean addNewClient(String nom, String description, int id_groupe_ordinateur, int status, String mac_address, Message msg)
	{
	    if (!nom.matches("^([1-9]\\d{0,2}\\.){3}[1-9]\\d{0,2}$"))
		msg.errorMessage("1", "Bad IP Address");
	    else if (!mac_address.matches("^(([0-9a-fA-F]){1,2}[-:]){5}([0-9a-fA-F]){1,2}$"))
		msg.errorMessage("1", "Bad Mac Address");
	    else if (isAuth(nom, mac_address))
		msg.errorMessage("1", "IP Address or Mac Address already registered in database");
	    else
	    	executeUpdateQuery("INSERT INTO ordinateur (nom, description, groupe_ordinateur_id_groupe_ordinateur, statut, mac_address, id_ordinateur_type) VALUES ('" + nom + "', '" + description + "', '" + id_groupe_ordinateur + "', '" + status + "', '" + mac_address + "', 1)");
	    return true;
	}

	public boolean isAuth(String nom) {
	    ArrayList<String> res = executeQuery("SELECT * FROM ordinateur WHERE nom = '" + nom + "'", 1);
	    if (res.size() > 0)
	    	return true;
	    return false;
	}

    public boolean isAuth(String nom, String macAddress) {
	    ArrayList<String> res = executeQuery("SELECT * FROM ordinateur WHERE nom = '" + nom + "' AND mac_address = '" + macAddress + "'", 1);
	    if (res.size() > 0)
	    	return true;	    
	    return false;
	}

	private int getCurrentWeekDay()
	{
		Calendar cal = Calendar.getInstance();
		return(cal.get(Calendar.DAY_OF_WEEK ) - 1);
	}
	
	private long getTimeDiff(String sD1) throws ParseException
	{
		Calendar cal = Calendar.getInstance();
		SimpleDateFormat df = new SimpleDateFormat("hh:mm:ss");
		if (sD1.length() > 0)
		{
			String[] tmp = sD1.split(":");
			if (tmp.length == 2)
				sD1 += ":00";
		}
	    Date d1 = df.parse(sD1);
	    Date d2 = df.parse(cal.get(Calendar.HOUR_OF_DAY) + ":" + cal.get(Calendar.MINUTE) + ":" + cal.get(Calendar.SECOND));
	    long d1Ms = d1.getTime();
	    long d2Ms = d2.getTime();
	    return ((d1Ms-d2Ms)/60000);
	}
	
	public int getPlanning(String IPAddress, String MacAddress, Message msg) throws  ParseException
	{
	    if (!isAuth(IPAddress, MacAddress))
	      msg.errorMessage("2", "Access Denied");
	    if (!auditMode)
	    {
		    ArrayList<String[]> res = executeQuery("SELECT * FROM planning_taches WHERE planning_id_planning = (SELECT planning_id_planning FROM  `groupe_ordinateur` WHERE id_groupe_ordinateur = (SELECT groupe_ordinateur_id_groupe_ordinateur FROM ordinateur WHERE nom =  '" + IPAddress + "' AND mac_address =  '" + MacAddress + "' ))");
			for (int i = 0; i != res.size(); i++)
			{
			    if ((((String[])(res.toArray()[i]))[3] == null) ||
					((String[])(res.toArray()[i]))[3].equals("") || 
					Integer.parseInt(((String[])(res.toArray()[i]))[3]) == getCurrentWeekDay())
						if (getTimeDiff(((String[])(res.toArray()[i]))[4]) < 0 && getTimeDiff(((String[])(res.toArray()[i]))[5]) > 0)
							return (Integer.parseInt(((String[])(res.toArray()[i]))[6]));
			}
	    }
		stockReporting(IPAddress, MacAddress, msg);
		return (1);
	}
	
	public String isAuditMode() {
		return String.valueOf(auditMode);
	}
	
	private Date getDate(String date)
	{
		Date dateObj = null;
		DateFormat formatter = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
	    try {
			dateObj = (Date)formatter.parse(date);
		} catch (ParseException e) {
			e.printStackTrace();
		}
		return dateObj;
	}
	
	private String[] getLastEntry(String IPAddress, String MacAddress)
	{
		ArrayList<String[]> res = executeQuery2("SELECT * FROM reporting WHERE id_ordinateur = (SELECT id_ordinateur FROM ordinateur WHERE nom =  '" + IPAddress + "' AND mac_address =  '" + MacAddress + "' ) ORDER BY date DESC LIMIT 1");
		if (res.isEmpty())
			return null;
		return res.get(0);
	}

	private void createReportingEntry(String IPAddress, String MacAddress, Message msg)
	{
		int audit = 0;
		if (auditMode)
			audit = 1;
		Date date = new Date();
		ArrayList<String[]> res = executeQuery2("SELECT id_ordinateur FROM ordinateur WHERE nom =  '" + IPAddress + "' AND mac_address =  '" + MacAddress + "'");
		String id[] = res.get(0);
		DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
		String strDate = dateFormat.format(date);
		executeUpdateQuery("INSERT INTO  `reporting` (`id` ,`id_ordinateur` ,`is_audit` ,`date` ,`last_received` ,`temps`) VALUES (NULL ,  '" + id[0] + "',  '" + audit + "',  '" + strDate + "', CURRENT_TIMESTAMP ,  '" + nextRequest + "');");
		//executeUpdateQuery("INSERT INTO  `eip_webapp`.`reporting` (`id` ,`id_ordinateur` ,`is_audit` ,`date` ,`nb_cycle` ,`intervalle`)	VALUES (NULL , '" + id[0] + "' ,  '" + audit + "', '" + strDate + "'  ,  '1',  '" + nextRequest + "');");
	}
	
	private void createReportingEntry(String IPAddress, String MacAddress, Message msg, String id)
	{
		int audit = 0;
		if (auditMode)
			audit = 1;
		Date date = new Date();
		DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
		String strDate = dateFormat.format(date);
		executeUpdateQuery("INSERT INTO `reporting` (`id` ,`id_ordinateur` ,`is_audit` ,`date` ,`last_received` ,`temps`) VALUES (NULL ,  '" + id + "',  '" + audit + "',  '" + strDate + "', CURRENT_TIMESTAMP ,  '" + nextRequest + "');");
	}
	
	private void adjustTime(String IPAddress, String MacAddress, Message msg, String[] entry)
	{
		int time = Integer.parseInt(entry[5]) + Integer.parseInt(nextRequest);
		executeUpdateQuery("UPDATE `reporting` SET  `temps` =  '" + time + "' WHERE  `reporting`.`id` = '" + entry[0]  + "';");
		/*Date now = new Date();
		Date last = getDate(entry[3]);
		
		long diff = (Math.abs(now.getTime() - last.getTime()) / 60000);
		if (((diff) >= (Integer.parseInt(entry[4]) * Integer.parseInt(nextRequest)) - 2) &&
				((diff) <= (Integer.parseInt(entry[4]) * Integer.parseInt(nextRequest)) + 2))
			executeUpdateQuery("UPDATE  `eip_webapp`.`reporting` SET  `nb_cycle` =  '" + (Integer.parseInt(entry[4]) + 1) + "' WHERE  `reporting`.`id` = '" + entry[0] + "';");
		else
			createReportingEntry(IPAddress, MacAddress, msg, entry[1]);*/
	}
	
	private boolean stockReporting(String IPAddress, String MacAddress, Message msg)
	{
		String[] entry = getLastEntry(IPAddress, MacAddress);
		if (entry == null)
			createReportingEntry(IPAddress, MacAddress, msg);
		else
		{
			Date date = new Date();
			DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
			String strDate = dateFormat.format(date);
			
			if (strDate.equals(entry[3]))
				adjustTime(IPAddress, MacAddress, msg, entry);
			else
				createReportingEntry(IPAddress, MacAddress, msg, entry[1]);
			/*if (!entry[5].equals(nextRequest))
				createReportingEntry(IPAddress, MacAddress, msg, entry[1]);
			else
				adjustCycle(IPAddress, MacAddress, msg, entry);*/
		}
		return true;
	}

	public Connection dbConnect()
	{
		try {
			if (mysql)
				connectMysql();
			else
				connectSqlite();
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
			return null;
		} catch (SQLException e) {
			e.printStackTrace();
			return null;
		}
		return conn;
	}

	private void connectMysql() throws ClassNotFoundException, SQLException {
		String driverName = "org.gjt.mm.mysql.Driver";
		Class.forName(driverName);

		String serverName = "127.0.0.1:" + db_port;
		String url = "jdbc:mysql://" + serverName + "/" + db_name;
		conn = DriverManager.getConnection(url, db_user, db_pwd);
		//System.out.println("Connected to " + db + " database");
	}

	private void connectSqlite() throws ClassNotFoundException, SQLException
	{
		String driverName = "org.sqlite.JDBC";
		Class.forName(driverName);
		String url;
		url = "jdbc:sqlite:" + db_name;
		conn = DriverManager.getConnection(url);
		//System.out.println("Connected to " + db_name + " SQLite database");
	}
	
	
	public void dbClose() {
		if (conn != null) {
			try {
				conn.close();
				//System.out.println("Database connection terminated");
			} catch (Exception e) {
			}
		}
	}

	private void executeUpdateQuery(String query) {
		try {
			
			Statement stmt = conn.createStatement();
			stmt.executeUpdate(query);
			stmt.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
	
	private ArrayList<String> executeQuery(String query, int col) {
		ArrayList<String> result = new ArrayList<String>();
		try {
			Statement stmt = conn.createStatement();
			ResultSet rs = stmt.executeQuery(query);
			while (rs.next())
				result.add(rs.getString(col));
			rs.close();
			stmt.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return (result);
	}

	private ArrayList<String[]> executeQuery2(String query) {
		ArrayList<String[]> result = new ArrayList<String[]>();
		try {
			Statement stmt = conn.createStatement();
			ResultSet rs = stmt.executeQuery(query);
			ResultSetMetaData meta = rs.getMetaData();
			int colcount = meta.getColumnCount();
			while (rs.next())
			{
				String[] allres = new String[colcount];
				for (int i = 0; i != colcount; i++)
					allres[i] = rs.getString(i + 1);
				result.add(allres);
			}
			rs.close();
			stmt.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return (result);
	}
	
	private ArrayList<String[]> executeQuery(String query) {
		ArrayList<String[]> result = new ArrayList<String[]>();
		try {
			Statement stmt = conn.createStatement();
			ResultSet rs = stmt.executeQuery(query);
			ResultSetMetaData meta = rs.getMetaData();
			int colcount = meta.getColumnCount();
			while (rs.next())
			{
				String[] allres = new String[colcount];
				for (int i = 1; i < colcount; i++)
					allres[i - 1] = rs.getString(i);
				allres[6] = rs.getString("action");
				result.add(allres);
			}
			rs.close();
			stmt.close();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return (result);
	}

}
