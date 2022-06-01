import java.util.*;

public class Main
{
    public static void main(String args[])
    {
        System.out.println("\nWELCOME TO TOKOAPP");
        System.out.println("-------------------------------------");
        System.out.println("-------------------------------------\n");

        int seller_ind = 0;
        int buyer_ind = 0;

        Seller seller = new Seller();

        //login signup
        while(true)
        {
            System.out.println("If you are a buyer press 0");
            System.out.println("If you are a seller press 1");
            System.out.printf("Choice : ");

            Scanner inp = new Scanner(System.in);
            int choice = inp.nextInt();

            if(choice == 0)
            {
                System.out.println("\nChoose 0 for Login");
                System.out.println("Choose 1 for Sign Up");
                
                System.out.printf("Choice : ");
                int c = inp.nextInt();

                if(c == 0)
                {
                    System.out.println("\n");
                    
                }
                else
                {

                }
            }
            else if(choice == 1)
            {   
                while(true)
                {
                    System.out.println("\nChoose 0 for Login");
                    System.out.println("Choose 1 for Sign Up");
                    System.out.println("Choose 2 for Back");
                    
                    System.out.printf("Choice : ");
                    int c = inp.nextInt();

                    if(c == 0)
                    {
                        System.out.println("\n");
                        String dummy = inp.nextLine();
                        System.out.printf("Username : ");
                        String username = inp.nextLine();
                        System.out.printf("Password : ");
                        String password = inp.nextLine();
                        seller.login(username, password);
                        seller_ind = 1;
                        break;
                    }
                    else if(c == 1)
                    {
                        String uniqueID = UUID.randomUUID().toString();
                        System.out.printf("Username : ");
                        String dummy = inp.nextLine();
                        String username = inp.nextLine();
                        System.out.printf("Password : ");
                        String password = inp.nextLine();
                        System.out.printf("Location : ");
                        String location = inp.nextLine();
                        seller.sign_up(uniqueID, username, password, location, 0);
                    }
                    else if(c == 2)
                    {
                        break;
                    }
                    else
                    {
                        System.out.println("Invalid Input!\n");
                    }
                }
            }
            else
            {
                System.out.println("Invalid Input!");
                System.out.println("Please Choose 0 or 1!\n");
            }

            if(seller_ind == 1 || buyer_ind == 1)
            {
                break;
            }
        }

        //after login
        if(seller_ind == 1)
        {
            seller.show_main_screen();

        }
        else if(buyer_ind == 1)
        {

        }

    }
}