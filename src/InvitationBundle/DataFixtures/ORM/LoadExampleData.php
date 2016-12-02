<?php
namespace InvitationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use InvitationBundle\Entity\Event;
use InvitationBundle\Entity\Invitation;
use InvitationBundle\Entity\Person;
use DateTime;

class LoadExampleData extends AbstractFixture implements OrderedFixtureInterface {
    const GENERATE_INVITATIONS = 0;
    
    protected $manager;
    
    public function load(ObjectManager $manager) {
        $this->manager = $manager;
        
        $User = $manager->getRepository('AppBundle:User')->findAll()[0];
            
        $EventType = $manager->getRepository('InvitationBundle:EventType')->findAll()[0];
        
        $Event = new Event;
        $Event->setName('Rocznica ślubu Kaliny i Pawła');
        $Event->setDate(new DateTime('2017-06-11'));
        $Event->setCreatedBy($User);
        $Event->setEventType($EventType);
        
        $this->manager->persist($Event);
        $this->manager->flush();
        if(self::GENERATE_INVITATIONS) {
            $this->generateInvitations($Event, 300, 5);
        }
    }
    
    protected function generateInvitations($Event, $numOfInvitation, $maxChild) {
        for($i=0; $i<$numOfInvitation; $i++) {
            $this->generateFamily($Event, $maxChild);
        }
    }
    
    protected function generateFamily($Event, $maxChild) {
        $people = array();
        $surname = $this->nazwiska[rand(0, count($this->nazwiska)-1)];
        $mom = $this->kobiety[rand(0, count($this->kobiety)-1)];
        $people[] = $mom.' '.$surname;
        $dad = $this->mezczyzni[rand(0, count($this->mezczyzni)-1)];
        $people[] = $dad.' '.$surname;
        $numOfChild = rand(0, $maxChild);
        $children = array();
        if($numOfChild > 0)
        for($i=0; $i< $numOfChild; $i++) {
            if(rand(0,1) == 1) {
                $child= $this->kobiety[rand(0, count($this->kobiety)-1)];
            } else {
                $child= $this->mezczyzni[rand(0, count($this->mezczyzni)-1)];
            }
            $children[] = $child;
            $people[] = $child.' '.$surname;
        }
        
        $invitationText = $mom.' i '.$dad.' '.$surname;
        if(count($children) > 0) {
            $invitationText.=' wraz z dziećmi';
        }
        
        
        $Invitation = new Invitation;
        $Invitation->setEvent($Event);
        $Invitation->setName($invitationText);
        $Invitation->setInnerOrder(0);
        $Invitation->setStatus(0);
        
        $this->manager->persist($Invitation);
        $this->manager->flush();
        
        foreach($people as $ord => $personName) {
            $Person = new Person;
            $Person->setName($personName);
            $Person->setInvitation($Invitation);
            $Person->setStatus(0);
            $Person->setInnerOrder($ord);
            
            $this->manager->persist($Person);
            $this->manager->flush();
        }
        
    }
    
    
    public function getOrder() {
        return 100;
    }
    
    
    protected $kobiety = array(
'Maria', 'Krystyna', 'Anna', 'Barbara', 'Teresa', 'Elżbieta', 'Janina', 'Zofia', 'Jadwiga', 'Danuta', 'Halina', 'Irena', 'Ewa', 'Małgorzata', 'Helena', 'Grażyna', 'Bożena', 'Stanisława', 'Jolanta', 'Marianna', 'Urszula', 'Wanda', 'Alicja', 'Dorota', 'Agnieszka', 'Beata', 'Katarzyna', 'Joanna', 'Wiesława', 'Renata', 'Iwona', 'Genowefa', 'Kazimiera', 'Stefania', 'Hanna', 'Lucyna', 'Józefa', 'Alina', 'Mirosława', 'Aleksandra', 'Władysława', 'Henryka', 'Czesława', 'Lidia', 'Regina', 'Monika', 'Magdalena', 'Bogumiła', 'Marta', 'Marzena', 'Leokadia', 'Mariola', 'Bronisława', 'Aniela', 'Bogusława', 'Eugenia', 'Izabela', 'Cecylia', 'Emilia', 'Łucja', 'Gabriela', 'Sabina', 'Zdzisława', 'Agata', 'Edyta', 'Aneta', 'Daniela', 'Wioletta', 'Sylwia', 'Weronika', 'Antonina', 'Justyna', 'Gertruda', 'Mieczysława', 'Franciszka', 'Rozalia', 'Zuzanna', 'Natalia', 'Celina', 'Ilona', 'Alfreda', 'Wiktoria', 'Olga', 'Wacława', 'Róża', 'Karolina', 'Bernadeta', 'Julia', 'Michalina', 'Adela', 'Ludwika', 'Honorata', 'Aldona', 'Eleonora', 'Violetta', 'Felicja', 'Walentyna', 'Pelagia', 'Apolonia', 'Brygida'
);

    protected $mezczyzni = array(
'Jan', 'Stanisław', 'Andrzej', 'Józef', 'Tadeusz', 'Jerzy', 'Zbigniew', 'Krzysztof', 'Henryk', 'Ryszard', 'Kazimierz', 'Marek', 'Marian', 'Piotr', 'Janusz', 'Władysław', 'Adam', 'Wiesław', 'Zdzisław', 'Edward', 'Mieczysław', 'Roman', 'Mirosław', 'Grzegorz', 'Czesław', 'Dariusz', 'Wojciech', 'Jacek', 'Eugeniusz', 'Tomasz', 'Stefan', 'Zygmunt', 'Leszek', 'Bogdan', 'Antoni', 'Paweł', 'Franciszek', 'Sławomir', 'Waldemar', 'Jarosław', 'Robert', 'Mariusz', 'Włodzimierz', 'Michał', 'Zenon', 'Bogusław', 'Witold', 'Aleksander', 'Bronisław', 'Wacław', 'Bolesław', 'Ireneusz', 'Maciej', 'Artur', 'Edmund', 'Marcin', 'Lech', 'Karol', 'Rafał', 'Arkadiusz', 'Leon', 'Sylwester', 'Lucjan', 'Julian', 'Wiktor', 'Romuald', 'Bernard', 'Ludwik', 'Feliks', 'Alfred', 'Alojzy', 'Przemysław', 'Cezary', 'Daniel', 'Mikołaj', 'Ignacy', 'Lesław', 'Radosław', 'Konrad', 'Bogumił', 'Szczepan', 'Gerard', 'Hieronim', 'Krystian', 'Leonard', 'Wincenty', 'Benedykt', 'Hubert', 'Sebastian', 'Norbert', 'Adolf', 'Łukasz', 'Emil', 'Teodor', 'Rudolf', 'Joachim', 'Jakub', 'Walenty', 'Alfons', 'Damian'
);

    protected $nazwiska = array(
'Nowak', 'Kowalski', 'Wiśniewski', 'Dąbrowski', 'Lewandowski', 'Wójcik', 'Kamiński', 'Kowalczyk', 'Zieliński', 'Szymański', 'Woźniak', 'Kozłowski', 'Jankowski', 'Wojciechowski', 'Kwiatkowski', 'Kaczmarek', 'Mazur', 'Krawczyk', 'Piotrowski', 'Grabowski', 'Nowakowski', 'Pawłowski', 'Michalski', 'Nowicki', 'Adamczyk', 'Dudek', 'Zając', 'Wieczorek', 'Jabłoński', 'Król', 'Majewski', 'Olszewski', 'Jaworski', 'Wróbel', 'Malinowski', 'Pawlak', 'Witkowski', 'Walczak', 'Stępień', 'Górski', 'Rutkowski', 'Michalak', 'Sikora', 'Ostrowski', 'Baran', 'Duda', 'Szewczyk', 'Tomaszewski', 'Pietrzak', 'Marciniak', 'Wróblewski', 'Zalewski', 'Jakubowski', 'Jasiński', 'Zawadzki', 'Sadowski', 'Bąk', 'Chmielewski', 'Włodarczyk', 'Borkowski', 'Czarnecki', 'Sawicki', 'Sokołowski', 'Urbański', 'Kubiak', 'Maciejewski', 'Szczepański', 'Kucharski', 'Wilk', 'Kalinowski', 'Lis', 'Mazurek', 'Wysocki', 'Adamski', 'Kaźmierczak', 'Wasilewski', 'Sobczak', 'Czerwiński', 'Andrzejewski', 'Cieślak', 'Głowacki', 'Zakrzewski', 'Kołodziej', 'Sikorski', 'Krajewski', 'Gajewski', 'Szymczak', 'Szulc', 'Baranowski', 'Laskowski', 'Brzeziński', 'Makowski', 'Ziółkowski', 'Przybylski', 'Domański', 'Nowacki', 'Borowski', 'Błaszczyk', 'Chojnacki', 'Ciesielski', 'Mróz', 'Szczepaniak', 'Wesołowski', 'Górecki', 'Krupa', 'Kaczmarczyk', 'Leszczyński', 'Lipiński', 'Kowalewski', 'Urbaniak', 'Kozak', 'Kania', 'Mikołajczyk', 'Czajkowski', 'Mucha', 'Tomczak', 'Kozioł', 'Markowski', 'Kowalik', 'Nawrocki', 'Brzozowski', 'Janik', 'Musiał', 'Wawrzyniak', 'Markiewicz', 'Orłowski', 'Tomczyk', 'Jarosz', 'Kołodziejczyk', 'Kurek', 'Kopeć', 'Żak', 'Wolski', 'Łuczak', 'Dziedzic', 'Kot', 'Stasiak', 'Stankiewicz', 'Piątek', 'Jóźwiak', 'Urban', 'Dobrowolski', 'Pawlik', 'Kruk', 'Domagała', 'Piasecki', 'Wierzbicki', 'Karpiński', 'Jastrzębski', 'Polak', 'Zięba', 'Janicki', 'Wójtowicz', 'Stefański', 'Sosnowski', 'Bednarek', 'Majchrzak', 'Bielecki', 'Małecki', 'Maj', 'Sowa', 'Milewski', 'Gajda', 'Klimek', 'Olejniczak', 'Ratajczak', 'Romanowski', 'Matuszewski', 'Śliwiński', 'Madej', 'Kasprzak', 'Wilczyński', 'Grzelak', 'Socha', 'Czajka', 'Marek', 'Kowal', 'Bednarczyk', 'Skiba', 'Wrona', 'Owczarek', 'Marcinkowski', 'Matusiak', 'Orzechowski', 'Sobolewski', 'Kędzierski', 'Kurowski', 'Rogowski', 'Olejnik', 'Dębski', 'Barański', 'Skowroński', 'Mazurkiewicz', 'Pająk', 'Czech', 'Janiszewski', 'Bednarski', 'Łukasik', 'Chrzanowski', 'Bukowski', 'Leśniak', 'Cieślik', 'Kosiński', 'Jędrzejewski', 'Muszyński', 'Świątek', 'Kozieł', 'Osiński', 'Czaja', 'Lisowski', 'Kuczyński', 'Żukowski', 'Grzybowski', 'Kwiecień', 'Pluta', 'Morawski', 'Czyż', 'Sobczyk', 'Augustyniak', 'Rybak', 'Krzemiński', 'Marzec', 'Konieczny', 'Marczak', 'Zych', 'Michalik', 'Michałowski', 'Kaczor', 'Świderski', 'Kubicki', 'Gołębiowski', 'Paluch', 'Białek', 'Niemiec', 'Sroka', 'Stefaniak', 'Cybulski', 'Kacprzak', 'Marszałek', 'Kasprzyk', 'Małek', 'Szydłowski', 'Smoliński', 'Kujawa', 'Lewicki', 'Przybysz', 'Stachowiak', 'Popławski', 'Piekarski', 'Matysiak', 'Janowski', 'Murawski', 'Cichocki', 'Witek', 'Niewiadomski', 'Staniszewski', 'Bednarz', 'Lech', 'Rudnicki', 'Kulesza', 'Piątkowski', 'Turek', 'Chmiel', 'Biernacki', 'Sowiński', 'Skrzypczak', 'Podgórski', 'Cichoń', 'Rosiński', 'Karczewski', 'Żurek', 'Drozd', 'Żurawski', 'Pietrzyk', 'Komorowski', 'Antczak', 'Gołębiewski', 'Góra', 'Banach', 'Filipiak', 'Grochowski', 'Krzyżanowski', 'Graczyk', 'Przybyła', 'Gruszka', 'Banaś', 'Klimczak', 'Siwek', 'Konieczna', 'Serafin', 'Bieniek', 'Godlewski', 'Rak', 'Kulik', 'Maćkowiak', 'Zawada', 'Mikołajczak', 'Różański', 'Cieśla', 'Długosz', 'Śliwa', 'Ptak', 'Strzelecki', 'Zarzycki', 'Mielczarek', 'Kłos', 'Bartkowiak', 'Leśniewski', 'Krawiec', 'Górka', 'Janiak', 'Kaczyński', 'Bartczak', 'Winiarski', 'Tokarski', 'Gil', 'Panek', 'Konopka', 'Frankowski', 'Banasiak', 'Grzyb', 'Rakowski', 'Kuś', 'Dudziński', 'Zaremba', 'Skowron', 'Fijałkowski', 'Dobosz', 'Witczak', 'Nawrot', 'Królikowski', 'Młynarczyk', 'Sienkiewicz', 'Frączek', 'Słowik', 'Frąckowiak', 'Czyżewski', 'Kostrzewa', 'Kucharczyk', 'Gawroński', 'Rybicki', 'Pałka', 'Biernat', 'Różycki', 'Bogusz', 'Rogalski', 'Szymczyk', 'Janus', 'Szczepanik', 'Szczygieł', 'Buczek', 'Szostak', 'Kaleta', 'Kaczorowski', 'Żebrowski', 'Tkaczyk', 'Grzegorczyk', 'Drzewiecki', 'Trojanowski', 'Bagiński', 'Książek', 'Jurek', 'Trzciński', 'Gawron', 'Wojtczak', 'Rogala', 'Kula', 'Kubik', 'Maliszewski', 'Radomski', 'Dąbek', 'Kisiel', 'Cebula', 'Rosiak', 'Zaręba', 'Gąsior', 'Grzesiak', 'Gawlik', 'Cygan', 'Rojek', 'Dębowski', 'Bogucki', 'Więckowski', 'Mikulski', 'Walkowiak', 'Malec', 'Burzyński', 'Flis', 'Wąsik', 'Czapla', 'Drozdowski', 'Kwaśniewski', 'Wójcicki', 'Rzepka', 'Gałązka', 'Łukasiewicz', 'Pawelec', 'Lipski', 'Wnuk', 'Kołodziejski', 'Andrzejczak', 'Zaborowski', 'Sokół', 'Urbańczyk', 'Falkowski', 'Filipek', 'Jędrzejczak', 'Ciszewski', 'Zajączkowski', 'Nowaczyk', 'Bielawski', 'Węgrzyn', 'Krysiak', 'Hajduk', 'Lisiecki', 'Mroczek', 'Jagodziński', 'Szafrański', 'Białas', 'Pietras', 'Karwowski', 'Żmuda', 'Lach', 'Kałuża', 'Dziuba', 'Wroński', 'Gruszczyński', 'Skibiński', 'Borek', 'Krakowiak', 'Wasiak', 'Jagiełło', 'Skrzypek', 'Lasota', 'Mika', 'Masłowski', 'Juszczak', 'Borowiec', 'Raczyński', 'Sobieraj', 'Ślusarczyk', 'Karaś', 'Dubiel', 'Łukaszewski', 'Dominiak', 'Kmiecik', 'Bujak', 'Kubacki', 'Pilarski', 'Gutowski', 'Misiak', 'Tarnowski', 'Bartosik', 'Mierzejewski', 'Kopczyński', 'Jakubiak', 'Twardowski', 'Zielonka', 'Jezierski', 'Jurkiewicz', 'Łapiński', 'Florczak', 'Gąsiorowski', 'Pakuła', 'Piórkowski', 'Janas', 'Bilski', 'Stelmach', 'Bochenek', 'Stec', 'Staszewski', 'Dudziak', 'Noga', 'Skoczylas', 'Pasternak', 'Dobrzyński', 'Górniak', 'Matuszak', 'Piwowarczyk', 'Filipowicz', 'Milczarek', 'Kędziora', 'Adamus', 'Cholewa', 'Słowiński', 'Olczak', 'Koza', 'Jędrzejczyk', 'Czechowski', 'Gaweł', 'Jaśkiewicz', 'Wilczek', 'Kaczmarski', 'Jankowiak', 'Krupiński', 'Strzelczyk', 'Kubica', 'Misztal', 'Sieradzki', 'Iwański', 'Sławiński', 'Adamczak', 'Szwed', 'Zwoliński', 'Zygmunt', 'Paczkowski', 'Kapusta', 'Adamek', 'Stępniak', 'Modzelewski', 'Majcher', 'Jackowski', 'Siedlecki', 'Niedzielski', 'Adamiak', 'Malicki', 'Szcześniak', 'Sołtys', 'Florek', 'Ruciński', 'Kaszuba', 'Bober', 'Kwieciński', 'Adamowicz', 'Sochacki', 'Grzywacz', 'Gołąb', 'Dec', 'Włodarski', 'Stolarczyk', 'Bieńkowski', 'Niemczyk', 'Szyszka', 'Mroczkowski', 'Prokop', 'Góral', 'Stanisławski', 'Dudzik', 'Stanek', 'Kuc', 'Molenda', 'Paszkowski', 'Sitek', 'Świerczyński', 'Suski', 'Drabik', 'Czekaj', 'Rusin', 'Gałka', 'Czerniak', 'Kępa', 'Frątczak', 'Guzik', 'Kuchta', 'Budzyński', 'Chojnowski', 'Szatkowski', 'Kruszewski', 'Kowalczuk', 'Więcek', 'Kaniewski', 'Skóra', 'Pytel', 'Puchalski', 'Kotowski', 'Augustyn', 'Michałek', 'Szczęsny', 'Żuk', 'Zdunek', 'Urbanowicz', 'Wolak', 'Kolasa', 'Januszewski', 'Kobus', 'Piechota', 'Pawlikowski', 'Skalski', 'Bożek', 'Motyka', 'Urbanek', 'Bielak', 'Zagórski', 'Banasik', 'Wypych', 'Rosa', 'Lipka', 'Dąbkowski', 'Trzeciak', 'Płonka', 'Bąkowski', 'Tomala', 'Partyka', 'Broda', 'Głąb', 'Kita', 'Jurkowski', 'Kiełbasa', 'Głogowski', 'Piłat', 'Knapik', 'Michalczyk', 'Kołakowski', 'Dróżdż', 'Białkowski', 'Przybył', 'Stolarski', 'Napierała', 'Balcerzak', 'Ziętek', 'Aleksandrowicz', 'Buczkowski', 'Sołtysiak', 'Marchewka', 'Koper', 'Robak', 'Cichy', 'Miśkiewicz', 'Buczyński', 'Rybarczyk', 'Stachura', 'Mrozek', 'Woś', 'Kłosowski', 'Jagielski', 'Janusz', 'Pawlicki', 'Górny', 'Skowronek', 'Kasperek', 'Grześkowiak', 'Warchoł', 'Szymkowiak', 'Grudzień', 'Wyszyński', 'Żyła', 'Woliński', 'Maciąg', 'Rudziński', 'Furman', 'Flak', 'Stachurski', 'Grzesik', 'Mackiewicz', 'Zabłocki', 'Wojtas', 'Korzeniowski', 'Niedziela', 'Gwóźdź', 'Gadomski', 'Błaszczak', 'Budziński', 'Ossowski', 'Piotrowicz', 'Prus', 'Pietruszka', 'Kuciński', 'Chmura', 'Kostecki', 'Jarząbek', 'Golec', 'Jaros', 'Radecki', 'Chudzik', 'Duszyński', 'Niedźwiecki', 'Surma', 'Kawecki', 'Wojtkowiak', 'Bartnik', 'Wolny', 'Szczerba', 'Maślanka', 'Szczęsna', 'Wiącek', 'Majka', 'Tracz', 'Szeląg', 'Kogut', 'Stawicki', 'Nowiński', 'Rudzki', 'Kuliński', 'Wojtasik', 'Izdebski', 'Stachowicz', 'Kalisz', 'Kulig', 'Adamiec', 'Krukowski', 'Jóźwik', 'Kos', 'Miller', 'Lenart', 'Kosowski', 'Kmieć', 'Pilch', 'Lesiak', 'Porębski', 'Szwarc', 'Herman', 'Kujawski', 'Kawa', 'Bielski', 'Grudziński', 'Kuźma', 'Roszak', 'Krasowski', 'Bieliński', 'Skorupa', 'Malik', 'Gorczyca', 'Krakowski', 'Banaszek', 'Łukaszewicz', 'Dymek', 'Dziura', 'Sobański', 'Drożdż', 'Sojka', 'Ratajczyk', 'Salamon', 'Trela', 'Rudnik', 'Adamczewski', 'Tomasik', 'Śmigielski', 'Wojda', 'Wrzesiński', 'Dzikowski', 'Wołoszyn', 'Dutkiewicz', 'Kopacz', 'Studziński', 'Ciołek', 'Sęk', 'Magiera', 'Ambroziak', 'Moskal', 'Bobrowski', 'Ślęzak', 'Olczyk', 'Śledź', 'Filip', 'Kawka', 'Bury', 'Dolata', 'Rożek', 'Pełka', 'Świątkowski', 'Korczak', 'Jurczyk', 'Litwin', 'Woźnica', 'Sobota', 'Paprocki', 'Roman', 'Warzecha', 'Szuba', 'Mielcarek', 'Rogoziński', 'Piętka', 'Kraszewski', 'Makuch', 'Kosmala', 'Kozik', 'Rusek', 'Żuchowski', 'Paszkiewicz', 'Juszczyk', 'Jurczak', 'Lewiński', 'Górna', 'Królak', 'Roszkowski', 'Piwowarski', 'Korzeniewski', 'Rybka', 'Jeziorski', 'Pogorzelski', 'Szkudlarek', 'Lipiec', 'Sidor', 'Mierzwa', 'Ryś', 'Małkowski', 'Czarnota', 'Werner', 'Karcz', 'Kruszyński', 'Grabarczyk', 'Turowski', 'Staszak', 'Gut', 'Bogdański', 'Figura', 'Wyrzykowski', 'Siwiec', 'Rzepecki', 'Gola', 'Figiel', 'Szot', 'Kurzawa', 'Karolak', 'Ferenc', 'Kozakiewicz', 'Kwiatek', 'Biskup', 'Piechocki', 'Kokot', 'Raczkowski', 'Kapuściński', 'Banaszak', 'Cichosz', 'Biliński', 'Sekuła', 'Doliński', 'Szopa', 'Krauze', 'Szymanek', 'Bogacz', 'Białecki', 'Antoniak', 'Suchecki', 'Czuba', 'Goliński', 'Szymanowski', 'Stępniewski', 'Grodzki', 'Jakubczyk', 'Wojtowicz', 'Wach', 'Tokarz', 'Tkacz', 'Lange', 'Kolasiński', 'Olszak', 'Filipczak', 'Bartoszek', 'Kochański', 'Perkowski', 'Kaliński', 'Czapliński', 'Rokicki', 'Kaźmierski', 'Grzybek', 'Brodowski', 'Paradowski', 'Lorenc', 'Reszka', 'Konarski', 'Kępka', 'Romański', 'Kusiak', 'Hoffmann', 'Barszcz', 'Nadolski', 'Piech', 'Puchała', 'Jaroszewski', 'Ławniczak', 'Waszkiewicz', 'Niezgoda', 'Janczak', 'Iwanowski', 'Polański', 'Plichta', 'Potocki', 'Bugaj', 'Szarek', 'Lachowicz', 'Franczak', 'Kupiec', 'Jaskulski', 'Borys', 'Gliński', 'Domagalski', 'Knap', 'Kazimierczak', 'Kruczek', 'Oleksy', 'Majkowski', 'Zarębski', 'Olech', 'Solecki', 'Bojarski', 'Szymaniak', 'Kukla', 'Wrzosek', 'Gołąbek', 'Kołodziejczak', 'Kempa', 'Ćwikliński', 'Nalepa', 'Frankiewicz', 'Stachowski', 'Piskorz', 'Kozera', 'Osuch', 'Łoś', 'Dobrzański', 'Szadkowski', 'Wachowiak', 'Ćwik', 'Dusza', 'Radziszewski', 'Wdowiak', 'Osowski', 'Jakubiec', 'Brzeski', 'Szczygielski', 'Pasek', 'Śpiewak', 'Drąg', 'Brożek', 'Wielgus', 'Koprowski', 'Bugajski', 'Okoń', 'Królik', 'Antkowiak', 'Matczak', 'Balicki', 'Galiński', 'Pisarek', 'Wagner', 'Modrzejewski', 'Kawalec', 'Traczyk', 'Gładysz', 'Jaskólski', 'Wiśniowski', 'Błażejewski', 'Dudkiewicz', 'Woźny', 'Romaniuk', 'Czubak', 'Bernat', 'Czerwonka', 'Pękala', 'Iwanicki', 'Szczurek', 'Świder', 'Iwaniuk', 'Morawiec', 'Szpak', 'Wojtaszek', 'Smolarek', 'Garbacz', 'Kostrzewski', 'Mączka', 'Kędzior', 'Błaszkiewicz', 'Klimaszewski', 'Drewniak', 'Kokoszka', 'Liszka', 'Marczewski', 'Szubert', 'Gałecki', 'Świtała', 'Jedynak', 'Pelc', 'Gacek', 'Kulikowski', 'Spychała', 'Dębicki', 'Gąsiorek', 'Sobociński', 'Grabski', 'Kochanowski', 'Góralczyk', 'Płatek', 'Łach', 'Caban', 'Grela', 'Rodak', 'Tuszyński', 'Zasada', 'Burek', 'Mularczyk', 'Słomiński', 'Maziarz', 'Bartosiewicz', 'Pietrzykowski', 'Biela', 'Pięta', 'Nosal', 'Cieśliński', 'Miszczak', 'Piszczek', 'Zborowski', 'Bator', 'Kapica', 'Orzeł', 'Skwarek', 'Winnicki', 'Galas', 'Gaj', 'Dawid', 'Kłosiński', 'Gajek', 'Włoch', 'Stokłosa', 'Podsiadło', 'Sarnowski', 'Plewa', 'Młynarski', 'Bień', 'Ludwiczak', 'Przybyszewski', 'Czapski', 'Błoński', 'Szeliga', 'Biały', 'Szweda', 'Kostka', 'Pierzchała', 'Napiórkowski', 'Daniel', 'Burda', 'Cyran', 'Kulpa', 'Surowiec', 'Wiszniewski', 'Kornacki', 'Skorupski', 'Guz', 'Dworak', 'Kozicki', 'Sobczyński', 'Słomka', 'Wydra', 'Pastuszka', 'Lemański', 'Frydrych', 'Furtak', 'Sala', 'Sułkowski', 'Jończyk', 'Klimas', 'Półtorak', 'Mieczkowski', 'Makarewicz', 'Walczyk', 'Wajda', 'Schmidt', 'Grygiel', 'Zawistowski', 'Weber', 'Dylewski', 'Nycz', 'Strzałkowski', 'Buda', 'Borowiak', 'Baron', 'Rybacki', 'Dul', 'Oleś', 'Nowosielski', 'Fabisiak', 'Rychlik', 'Zapała', 'Góralski', 'Rybiński', 'Lewczuk', 'Pluciński', 'Czaplicki', 'Kraski', 'Rumiński', 'Jamróz', 'Kołacz', 'Iwan', 'Matuszczak', 'Rokita', 'Mrowiec', 'Sitko', 'Marcinkiewicz', 'Waligóra', 'Stencel', 'Chudy', 'Janeczek', 'Lasek', 'Kałużny', 'Waszak', 'Czapiewski', 'Sudoł', 'Paszek', 'Kozyra', 'Szmidt', 'Nocoń', 'Ogórek', 'Zawiślak', 'Baczyński', 'Sosiński', 'Wilczewski', 'Mach', 'Turski', 'Zaleski', 'Wasielewski', 'Łuczyński', 'Wielgosz', 'Osiecki', 'Pisarski', 'Bernacki', 'Bartnicki', 'Gołaszewski', 'Kasperski', 'Jakubczak', 'Bryła', 'Stopa', 'Zatorski', 'Wąsowski', 'Kalita', 'Zawisza', 'Trzaski', 'Mikuła', 'Siuda', 'Dzięcioł', 'Panasiuk', 'Pilarczyk', 'Wiliński', 'Świerczek', 'Bojanowski', 'Wierzchowski', 'Tarka', 'Tymiński', 'Cicha', 'Neumann', 'Myśliwiec', 'Grzegorzewski', 'Wcisło', 'Musioł', 'Kluski', 'Cywiński', 'Kalbarczyk', 'Miś', 'Seweryn', 'Kulas', 'Świercz', 'Walas', 'Radzikowski', 'Machnik', 'Boroń', 'Kreft', 'Miler', 'Kościelniak', 'Krawczyński', 'Bartkowski', 'Smoleń', 'Ozga', 'Koziński', 'Celiński', 'Giza', 'Mikołajewski', 'Gąska', 'Śliwka', 'Klonowski'
);
}